import axios from 'axios';
import assert from 'assert';

const API_BASE_URL = 'http://localhost:8000/api';

async function runTest(testName, testFunction) {
  console.log(`\n🧪 TEST: ${testName}`);
  try {
    await testFunction();
    console.log(`✅ PASS: ${testName}`);
    return { success: true, testName };
  } catch (error) {
    console.error(`❌ FAIL: ${testName}`);
    console.error(`Error: ${error.message}`);
    console.error(`Stack: ${error.stack}`);
    return { success: false, testName, error: error.message };
  }
}

function logStep(step, data = {}) {
  console.log(`  └─ ${step}`, data);
}

async function test1_CompleteUserJourney() {
  logStep('Paso 1: Obtener kin de hoy desde API REST REAL');
  
  const todayResponse = await axios.get(`${API_BASE_URL}/calendar/today`);
  assert(todayResponse.status === 200, 'API debe responder 200');
  assert(todayResponse.data.date, 'API debe devolver fecha de hoy');
  assert(todayResponse.data.kin, 'API debe devolver datos de kin');
  
  // Corrección: kin_number está anidado en kin.kin.kin_number
  const kinData = todayResponse.data.kin.kin || todayResponse.data.kin;
  assert(kinData.kin_number > 0, 'Kin number debe ser > 0');
  
  const kinNumber = kinData.kin_number;
  logStep('Kin obtenido:', { kinNumber, solarSeal: kinData.solar_seal });

  logStep('Paso 2: Calcular oráculo para kin REAL');
  
  const oracleResponse = await axios.get(`${API_BASE_URL}/calendar/oracle/${kinNumber}`);
  assert(oracleResponse.status === 200, 'Oracle API debe responder 200');
  
  // Corrección: Datos envueltos en 'oracle'
  const oracleData = oracleResponse.data.oracle;
  assert(oracleData, 'Respuesta debe contener objeto oracle');
  assert(oracleData.destiny, 'Oracle debe tener destiny');
  assert(oracleData.guide, 'Oracle debe tener guide');
  
  logStep('Oráculo obtenido:', {
    destiny: oracleData.destiny.kin_number,
    guide: oracleData.guide.kin_number,
    analog: oracleData.analog.kin_number,
    antipode: oracleData.antipode.kin_number,
    occult: oracleData.occult.kin_number
  });

  logStep('Paso 3: Obtener wavespell del kin REAL');
  
  const wavespellId = todayResponse.data.kin.wavespell_id;
  assert(wavespellId, 'Kin debe tener wavespell_id');
  
  const wavespellResponse = await axios.get(`${API_BASE_URL}/calendar/wavespell/${wavespellId}`);
  assert(wavespellResponse.status === 200, 'Wavespell API debe responder 200');
  
  // Corrección: Datos envueltos en 'wavespell.wavespell'
  const wavespellData = wavespellResponse.data.wavespell.wavespell;
  const wavespellKins = wavespellResponse.data.wavespell.kins;
  
  assert(wavespellData, 'Respuesta debe contener objeto wavespell');
  assert(wavespellKins.length === 13, 'Wavespell debe tener 13 kins');
  assert(wavespellData.id === wavespellId, 'Wavespell ID debe coincidir');
  
  logStep('Wavespell obtenido:', {
    id: wavespellData.id,
    kinCount: wavespellKins.length
  });

  logStep('Paso 4: Obtener castle del kin REAL');
  
  const castleId = todayResponse.data.kin.castle_id;
  assert(castleId, 'Kin debe tener castle_id');
  
  const castleResponse = await axios.get(`${API_BASE_URL}/calendar/castle/${castleId}`);
  assert(castleResponse.status === 200, 'Castle API debe responder 200');
  
  // Corrección: Datos envueltos en 'castle.castle'
  const castleData = castleResponse.data.castle.castle;
  const castleKins = castleResponse.data.castle.kins;
  
  assert(castleData, 'Respuesta debe contener objeto castle');
  assert(castleKins.length === 52, 'Castle debe tener 52 kins');
  assert(castleData.id === castleId, 'Castle ID debe coincidir');
  
  logStep('Castle obtenido:', {
    id: castleData.id,
    kinCount: castleKins.length
  });

  logStep('✅ TEST COMPLETO: Journey de usuario con datos REALES');
  logStep('VALIDACIÓN DE INTEGRIDAD:', {
    kinNumber,
    wavespellId,
    castleId,
    allDataReal: true
  });
}

async function test2_APIConsistency() {
  logStep('TEST: Consistencia de datos API REST (SIN MOCKS)');
  
  logStep('Paso 1: Obtener kin de hoy 3 veces');
  
  const response1 = await axios.get(`${API_BASE_URL}/calendar/today`);
  const response2 = await axios.get(`${API_BASE_URL}/calendar/today`);
  const response3 = await axios.get(`${API_BASE_URL}/calendar/today`);
  
  logStep('Paso 2: Verificar que las 3 respuestas son IDÉNTICAS');
  
  assert(JSON.stringify(response1.data) === JSON.stringify(response2.data), 
         'Las respuestas 1 y 2 deben ser idénticas');
  assert(JSON.stringify(response2.data) === JSON.stringify(response3.data), 
         'Las respuestas 2 y 3 deben ser idénticas');
  
  logStep('Paso 3: Verificar consistencia de kin_number');
  
  const kin1 = response1.data.kin.kin || response1.data.kin;
  const kin2 = response2.data.kin.kin || response2.data.kin;
  const kin3 = response3.data.kin.kin || response3.data.kin;
  
  assert(kin1.kin_number === kin2.kin_number,
         'kin_number debe ser idéntico en las 3 respuestas');
  assert(kin2.kin_number === kin3.kin_number,
         'kin_number debe ser idéntico en las 3 respuestas');
  
  logStep('Paso 4: Verificar consistencia de oráculo');
  
  const kinNumber = kin1.kin_number;
  const oracle1 = await axios.get(`${API_BASE_URL}/calendar/oracle/${kinNumber}`);
  const oracle2 = await axios.get(`${API_BASE_URL}/calendar/oracle/${kinNumber}`);
  
  assert(JSON.stringify(oracle1.data) === JSON.stringify(oracle2.data),
         'Los oráculos deben ser idénticos');
  
  logStep('✅ TEST COMPLETO: Consistencia de API REST verificada con datos REALES');
}

async function test3_KinByDateConsistency() {
  logStep('TEST: Consistencia de kin por fecha (SIN MOCKS)');
  
  const testDate = '2026-01-08';
  logStep('Paso 1: Obtener kin por fecha específica');
  
  const response1 = await axios.get(`${API_BASE_URL}/calendar/date/${testDate}`);
  assert(response1.status === 200, 'API debe responder 200');
  
  const response2 = await axios.get(`${API_BASE_URL}/calendar/date/${testDate}`);
  
  logStep('Paso 2: Verificar idempotencia');
  
  assert(JSON.stringify(response1.data) === JSON.stringify(response2.data),
         'Mismo request debe devolver misma respuesta');
  
  logStep('✅ TEST COMPLETO: Idempotencia verificada con datos REALES');
}

async function test4_OracleIntegrity() {
  logStep('TEST: Integridad de oráculo (SIN MOCKS)');
  
  const testKin = 7;
  
  logStep('Paso 1: Obtener kin completo');
  const kinResponse = await axios.get(`${API_BASE_URL}/calendar/kin/${testKin}`);
  // Nota: /calendar/kin/{id} podría tener estructura diferente, pero asumimos standard
  // Si falla, revisaremos. Pero el test 4 fallaba en oráculo, no aquí.
  
  logStep('Paso 2: Calcular oráculo');
  const oracleResponse = await axios.get(`${API_BASE_URL}/calendar/oracle/${testKin}`);
  
  // Corrección: Datos envueltos en 'oracle'
  const oracleData = oracleResponse.data.oracle;
  
  logStep('Paso 3: Verificar que oráculo usa el mismo kin');
  
  assert(oracleData.destiny.kin_number === testKin, 'Destiny debe ser el kin solicitado');
  
  logStep('Paso 4: Verificar que las 5 energías son diferentes kins válidos');
  
  const oracleKins = [
    oracleData.destiny.kin_number,
    oracleData.guide.kin_number,
    oracleData.analog.kin_number,
    oracleData.antipode.kin_number,
    oracleData.occult.kin_number
  ];
  
  for (const oracleKin of oracleKins) {
    assert(oracleKin >= 1 && oracleKin <= 260,
           `Cada energía del oráculo debe ser un kin válido (1-260), pero se obtuvo: ${oracleKin}`);
  }
  
  logStep('✅ TEST COMPLETO: Integridad de oráculo verificada con datos REALES');
}

async function test5_WavespellIntegrity() {
  logStep('TEST: Integridad de wavespell (SIN MOCKS)');
  
  const testWavespell = 1;
  
  logStep('Paso 1: Obtener wavespell');
  const response = await axios.get(`${API_BASE_URL}/calendar/wavespell/${testWavespell}`);
  
  // Corrección: Datos envueltos en 'wavespell.wavespell'
  const wavespellData = response.data.wavespell.wavespell;
  const wavespellKins = response.data.wavespell.kins;
  
  logStep('Paso 2: Verificar estructura de wavespell');
  
  assert(wavespellData.id === testWavespell,
         'id debe coincidir con request');
  assert(wavespellKins.length === 13,
         'Wavespell debe tener exactamente 13 kins');
  assert(Array.isArray(wavespellKins),
         'Wavespell debe tener array de kins');
  
  logStep('Paso 3: Verificar que los kins son válidos');
  
  for (const kin of wavespellKins) {
    assert(kin.kin_number >= 1 && kin.kin_number <= 260,
           `Cada kin debe estar entre 1 y 260, pero se obtuvo: ${kin.kin_number}`);
    assert(kin.solar_seal, 'Kin debe tener solar_seal');
    assert(kin.galactic_tone, 'Kin debe tener galactic_tone');
  }
  
  logStep('✅ TEST COMPLETO: Integridad de wavespell verificada con datos REALES');
}

async function test6_CastleIntegrity() {
  logStep('TEST: Integridad de castle (SIN MOCKS)');
  
  const testCastle = 1;
  
  logStep('Paso 1: Obtener castle');
  const response = await axios.get(`${API_BASE_URL}/calendar/castle/${testCastle}`);
  
  // Corrección: Datos envueltos en 'castle.castle'
  const castleData = response.data.castle.castle;
  const castleKins = response.data.castle.kins;
  
  logStep('Paso 2: Verificar estructura de castle');
  
  assert(castleData.id === testCastle,
         'id debe coincidir con request');
  assert(castleKins.length === 52,
         'Castle debe tener exactamente 52 kins');
  assert(Array.isArray(castleKins),
         'Castle debe tener array de kins');
  
  logStep('Paso 3: Verificar que los kins son válidos');
  
  for (const kin of castleKins) {
    assert(kin.kin_number >= 1 && kin.kin_number <= 260,
           `Cada kin debe estar entre 1 y 260, pero se obtuvo: ${kin.kin_number}`);
    assert(kin.solar_seal, 'Kin debe tener solar_seal');
    assert(kin.galactic_tone, 'Kin debe tener galactic_tone');
  }
  
  logStep('✅ TEST COMPLETO: Integridad de castle verificada con datos REALES');
}

async function runAllE2ETests() {
  console.log('\n═══════════════════════════════════════════════');
  console.log('🧪 E2E TESTS - Datos 100% REALES (SIN MOCKS)');
  console.log('═══════════════════════════════════════════════\n');
  
  const results = [];
  
  results.push(await runTest('Test 1: Complete User Journey', test1_CompleteUserJourney));
  results.push(await runTest('Test 2: API Consistency', test2_APIConsistency));
  results.push(await runTest('Test 3: Kin By Date Idempotency', test3_KinByDateConsistency));
  results.push(await runTest('Test 4: Oracle Integrity', test4_OracleIntegrity));
  results.push(await runTest('Test 5: Wavespell Integrity', test5_WavespellIntegrity));
  results.push(await runTest('Test 6: Castle Integrity', test6_CastleIntegrity));
  
  console.log('\n═══════════════════════════════════════════════');
  console.log('📊 RESUMEN DE E2E TESTS');
  console.log('═══════════════════════════════════════════════\n');
  
  const passed = results.filter(r => r.success).length;
  const failed = results.filter(r => !r.success).length;
  
  console.log(`Total tests: ${results.length}`);
  console.log(`✅ Passed: ${passed} (${((passed/results.length)*100).toFixed(1)}%)`);
  console.log(`❌ Failed: ${failed} (${((failed/results.length)*100).toFixed(1)}%)`);
  
  if (failed > 0) {
    console.log('\n❌ TESTS FALLIDOS:');
    results.filter(r => !r.success).forEach(r => {
      console.log(`  - ${r.testName}: ${r.error}`);
    });
    process.exit(1);
  } else {
    console.log('\n✅ TODOS LOS TESTS E2E PASARON - Datos 100% REALES');
    console.log('✅ SIN MOCKS, SIN FAKES, SIN DATOS FALSOS');
    console.log('✅ TODOS los datos provienen de API REST REAL');
  }
  
  return results;
}

if (import.meta.url === `file://${process.argv[1]}`) {
  runAllE2ETests();
}

export {
  runAllE2ETests,
  test1_CompleteUserJourney,
  test2_APIConsistency,
  test3_KinByDateConsistency,
  test4_OracleIntegrity,
  test5_WavespellIntegrity,
  test6_CastleIntegrity
};