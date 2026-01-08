import axios from 'axios';

const API_BASE_URL = 'http://localhost:8000/api';

function assert(condition, message) {
  if (!condition) {
    throw new Error(`Assertion failed: ${message}`);
  }
}

function logTest(testName, status, details = '') {
  const statusEmoji = status === 'PASS' ? '✅' : status === 'FAIL' ? '❌' : '⚠️';
  console.log(`${statusEmoji} ${testName}`);
  if (details) console.log(`   ${details}`);
}

function logStep(step) {
  console.log(`\n📋 ${step}`);
}

function compareResponses(response1, response2) {
  const data1 = response1.data;
  const data2 = response2.data;

  if (JSON.stringify(data1) === JSON.stringify(data2)) {
    return { identical: true, differences: [] };
  }

  const differences = [];
  const keys = new Set([...Object.keys(data1), ...Object.keys(data2)]);

  keys.forEach(key => {
    const val1 = JSON.stringify(data1[key]);
    const val2 = JSON.stringify(data2[key]);

    if (val1 !== val2) {
      differences.push({
        field: key,
        value1: data1[key],
        value2: data2[key]
      });
    }
  });

  return { identical: false, differences };
}

async function checkAPIRunning() {
  try {
    const response = await axios.get(`${API_BASE_URL}/calendar/today`);
    return response.status === 200;
  } catch (error) {
    return false;
  }
}

async function test1_GetIdempotency() {
  logStep('TEST 1: Idempotencia de peticiones GET repetidas');

  const endpoints = [
    '/calendar/today',
    '/calendar/oracle/1',
    '/calendar/oracle/20',
    '/calendar/oracle/100',
    '/calendar/oracle/260'
  ];

  let passedEndpoints = 0;

  for (const endpoint of endpoints) {
    const numRequests = 5;
    const responses = [];

    try {
      logStep(`Probando ${endpoint} (${numRequests} peticiones)`);

      for (let i = 0; i < numRequests; i++) {
        const response = await axios.get(`${API_BASE_URL}${endpoint}`);
        responses.push(response);
      }

      let allIdentical = true;
      for (let i = 1; i < responses.length; i++) {
        const comparison = compareResponses(responses[0], responses[i]);
        if (!comparison.identical) {
          allIdentical = false;
          logTest(`${endpoint}: Idempotencia`, 'FAIL', 
                  `Petición 1 vs ${i + 1}: ${comparison.differences.length} diferencias`);
          comparison.differences.forEach(d => {
            console.log(`   Campo ${d.field}: "${d.value1}" vs "${d.value2}"`);
          });
        }
      }

      if (allIdentical) {
        logTest(`${endpoint}: Idempotencia`, 'PASS', 
                `${numRequests} peticiones idénticas`);
        passedEndpoints++;
      }

      assert(allIdentical, `${endpoint} debe ser idempotente`);

    } catch (error) {
      logTest(`${endpoint}: Idempotencia`, 'FAIL', error.message);
    }
  }

  logStep(`Resultado: ${passedEndpoints}/${endpoints.length} endpoints idempotentes`);
  assert(passedEndpoints === endpoints.length, 'Todos los endpoints GET deben ser idempotentes');
}

async function test2_ConcurrentRequestIdempotency() {
  logStep('TEST 2: Idempotencia bajo carga concurrente');

  const endpoint = '/calendar/today';
  const concurrentRequests = 10;

  try {
    const promises = [];
    for (let i = 0; i < concurrentRequests; i++) {
      promises.push(axios.get(`${API_BASE_URL}${endpoint}`));
    }

    const responses = await Promise.all(promises);

    let allIdentical = true;
    for (let i = 1; i < responses.length; i++) {
      const comparison = compareResponses(responses[0], responses[i]);
      if (!comparison.identical) {
        allIdentical = false;
        logTest('Concurrent Idempotency', 'FAIL', 
                `Petición 1 vs ${i + 1}: ${comparison.differences.length} diferencias`);
      }
    }

    if (allIdentical) {
      logTest('Concurrent Idempotency', 'PASS', 
              `${concurrentRequests} peticiones concurrentes idénticas`);
    }

    assert(allIdentical, 'Respuestas concurrentes deben ser idénticas');

  } catch (error) {
    logTest('Concurrent Idempotency', 'FAIL', error.message);
    throw error;
  }
}

async function test3_OracleStructureIdempotency() {
  logStep('TEST 3: Estructura de Oracle consistente entre llamadas');

  const kinNumbers = [1, 20, 100, 260];
  let passedKins = 0;

  for (const kinNumber of kinNumbers) {
    try {
      logStep(`Probando Oracle del Kin ${kinNumber}`);

      const response1 = await axios.get(`${API_BASE_URL}/calendar/oracle/${kinNumber}`);
      const response2 = await axios.get(`${API_BASE_URL}/calendar/oracle/${kinNumber}`);

      // Corrección: Datos en oracle
      const oracle1 = response1.data.oracle;
      const oracle2 = response2.data.oracle;

      const requiredOracleFields = ['destiny', 'analog', 'antipode', 'occult', 'guide'];
      let structureIdentical = true;

      requiredOracleFields.forEach(field => {
        const hasField1 = oracle1[field] !== undefined;
        const hasField2 = oracle2[field] !== undefined;

        if (hasField1 !== hasField2) {
          structureIdentical = false;
          logTest(`Kin ${kinNumber}: Oracle Structure`, 'FAIL', 
                  `Campo ${field} inconsistente entre llamadas`);
        }
      });

      if (structureIdentical) {
        const comparison = compareResponses(response1, response2);
        if (comparison.identical) {
          logTest(`Kin ${kinNumber}: Oracle Structure`, 'PASS', 
                  'Estructura y datos idénticos');
          passedKins++;
        } else {
          logTest(`Kin ${kinNumber}: Oracle Structure`, 'FAIL', 
                  `Datos diferentes: ${comparison.differences.length} campos`);
        }
      }

    } catch (error) {
      logTest(`Kin ${kinNumber}: Oracle Structure`, 'FAIL', error.message);
    }
  }

  logStep(`Resultado: ${passedKins}/${kinNumbers.length} Kins con estructura idempotente`);
  assert(passedKins === kinNumbers.length, 'Todos los Oracles deben ser idempotentes');
}

async function test4_RaceConditionIdempotency() {
  logStep('TEST 4: Sin condiciones de carrera en llamadas rápidas');

  const endpoint = '/calendar/oracle/1';
  const rapidRequests = 20;
  const delay = 10;

  try {
    const responses = [];
    const timestamps = [];

    const startTime = Date.now();

    for (let i = 0; i < rapidRequests; i++) {
      const promise = axios.get(`${API_BASE_URL}${endpoint}`);
      promise.then(res => {
        timestamps.push(Date.now() - startTime);
      });
      responses.push(promise);

      if (i < rapidRequests - 1) {
        await new Promise(resolve => setTimeout(resolve, delay));
      }
    }

    const settledResponses = await Promise.allSettled(responses);
    const successfulResponses = settledResponses
      .filter(r => r.status === 'fulfilled')
      .map(r => r.value);

    assert(successfulResponses.length === rapidRequests, 
           'Todas las peticiones deben completarse exitosamente');

    let allIdentical = true;
    for (let i = 1; i < successfulResponses.length; i++) {
      const comparison = compareResponses(successfulResponses[0], successfulResponses[i]);
      if (!comparison.identical) {
        allIdentical = false;
        logTest('Race Condition Idempotency', 'FAIL', 
                `Petición 1 vs ${i + 1}: ${comparison.differences.length} diferencias`);
      }
    }

    if (allIdentical) {
      logTest('Race Condition Idempotency', 'PASS', 
              `${rapidRequests} peticiones rápidas idénticas`);
    }

    assert(allIdentical, 'No debe haber condiciones de carrera');

  } catch (error) {
    logTest('Race Condition Idempotency', 'FAIL', error.message);
    throw error;
  }
}

async function test5_CachedVsUncachedIdempotency() {
  logStep('TEST 5: Consistencia entre llamadas con y sin caché');

  const kinNumber = 20;

  try {
    logStep('Primera llamada (sin caché)');
    const response1 = await axios.get(`${API_BASE_URL}/calendar/oracle/${kinNumber}`);

    await new Promise(resolve => setTimeout(resolve, 100));

    logStep('Segunda llamada (posiblemente con caché)');
    const response2 = await axios.get(`${API_BASE_URL}/calendar/oracle/${kinNumber}`);

    await new Promise(resolve => setTimeout(resolve, 100));

    logStep('Tercera llamada (después de espera)');
    const response3 = await axios.get(`${API_BASE_URL}/calendar/oracle/${kinNumber}`);

    const comparison12 = compareResponses(response1, response2);
    const comparison13 = compareResponses(response1, response3);
    const comparison23 = compareResponses(response2, response3);

    if (comparison12.identical && comparison13.identical && comparison23.identical) {
      logTest('Cached vs Uncached Idempotency', 'PASS', 
              'Todas las respuestas idénticas independientemente del caché');
    } else {
      logTest('Cached vs Uncached Idempotency', 'FAIL', 
              `Diferencias encontradas: 1vs2=${comparison12.differences.length}, ` +
              `1vs3=${comparison13.differences.length}, 2vs3=${comparison23.differences.length}`);
    }

    assert(comparison12.identical && comparison13.identical && comparison23.identical,
           'Caché no debe afectar la consistencia de los datos');

  } catch (error) {
    logTest('Cached vs Uncached Idempotency', 'FAIL', error.message);
    throw error;
  }
}

async function runAllTests() {
  console.log('\n========================================');
  console.log('🔬 INTEGRITY TESTS: IDEMPOTENCY');
  console.log('========================================');
  console.log('⚠️  CRÍTICO: 100% DATOS REALES - NINGÚN MOCK');
  console.log('========================================\n');

  const apiRunning = await checkAPIRunning();
  if (!apiRunning) {
    console.error('❌ ERROR: API REST no está corriendo en localhost:8000');
    console.log('   Inicia el servidor: cd backend && php artisan serve');
    process.exit(1);
  }

  console.log('✅ API REST está corriendo\n');

  const tests = [
    test1_GetIdempotency,
    test2_ConcurrentRequestIdempotency,
    test3_OracleStructureIdempotency,
    test4_RaceConditionIdempotency,
    test5_CachedVsUncachedIdempotency
  ];

  let passedTests = 0;

  for (const test of tests) {
    try {
      await test();
      passedTests++;
    } catch (error) {
      console.error(`   Error: ${error.message}`);
    }
    console.log('');
  }

  console.log('========================================');
  console.log(`📊 RESULTADOS: ${passedTests}/${tests.length} tests PASSED`);
  console.log('========================================\n');

  if (passedTests === tests.length) {
    console.log('✅ TODOS LOS TESTS DE IDEMPOTENCIA PASARON');
    console.log('✅ API 100% IDEMPOTENTE - SIN CONDICIONES DE CARRERA');
    console.log('✅ DATOS 100% REALES - SIN MOCKS');
  } else {
    console.log('❌ ALGUNOS TESTS FALLARON - REVISAR DETALLES');
    process.exit(1);
  }
}

if (import.meta.url === `file://${process.argv[1]}`) {
  runAllTests();
}

export {
  runAllTests,
  test1_GetIdempotency,
  test2_ConcurrentRequestIdempotency,
  test3_OracleStructureIdempotency,
  test4_RaceConditionIdempotency,
  test5_CachedVsUncachedIdempotency
};