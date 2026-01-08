import axios from 'axios';
import Database from 'better-sqlite3';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const API_BASE_URL = 'http://localhost:8000/api';
const DB_PATH = path.join(__dirname, '../../../backend/database/database.sqlite');

let db;

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

function normalizeValue(value) {
  if (value === true) return 1;
  if (value === false) return 0;
  if (value === 'true') return 1;
  if (value === 'false') return 0;
  // Normalizar fechas (quitar Z y milisegundos si es necesario para comparar con SQL)
  if (typeof value === 'string' && /^\d{4}-\d{2}-\d{2}T/.test(value)) {
    return value.replace('T', ' ').replace('.000000Z', '');
  }
  return value;
}

function compareWithDatabase(apiData, dbData, entityName) {
  const mismatches = [];

  Object.keys(apiData).forEach(key => {
    // Ignorar objetos anidados complejos
    if (typeof apiData[key] === 'object' && apiData[key] !== null) return;
    // Ignorar campos localizados que no están en DB directa
    if (key.endsWith('_es') || key === 'galactic_tone_name') return;

    const apiVal = normalizeValue(apiData[key]);
    const dbVal = normalizeValue(dbData[key]);

    if (dbData[key] !== undefined && apiVal != dbVal) { // Usar != para permitir coerción segura tras normalización
      mismatches.push({
        field: key,
        apiValue: apiData[key],
        dbValue: dbData[key]
      });
    }
  });

  return mismatches;
}

async function checkAPIRunning() {
  try {
    const response = await axios.get(`${API_BASE_URL}/calendar/today`);
    return response.status === 200;
  } catch (error) {
    return false;
  }
}

async function test1_KinDataConsistency() {
  logStep('TEST 1: Consistencia de datos de Kins entre API y Base de Datos');
  
  const sampleKins = [1, 20, 100, 260];
  let passedCount = 0;
  let totalCount = 0;

  for (const kinNumber of sampleKins) {
    totalCount++;
    logStep(`Verificando Kin ${kinNumber}`);

    try {
      const apiResponse = await axios.get(`${API_BASE_URL}/calendar/oracle/${kinNumber}`);
      const apiData = apiResponse.data.oracle.destiny;

      const dbKin = db.prepare('SELECT * FROM kins WHERE kin_number = ?').get(kinNumber);

      if (!dbKin) {
        logTest(`Kin ${kinNumber}: Datos en DB`, 'FAIL', 'No encontrado en base de datos');
        continue;
      }

      const mismatches = compareWithDatabase(apiData, dbKin, `kin_${kinNumber}`);

      if (mismatches.length === 0) {
        logTest(`Kin ${kinNumber}: API ↔ DB`, 'PASS', 'Datos completamente consistentes');
        passedCount++;
      } else {
        logTest(`Kin ${kinNumber}: API ↔ DB`, 'FAIL', `Inconsistencias encontradas: ${mismatches.length}`);
        mismatches.forEach(m => {
          console.log(`   Campo ${m.field}: API="${m.apiValue}" vs DB="${m.dbValue}"`);
        });
      }

      assert(apiData.kin_number === dbKin.kin_number, 'kin_number debe coincidir');
      assert(apiData.solar_seal === dbKin.solar_seal, 'solar_seal debe coincidir');
      assert(apiData.galactic_tone === dbKin.galactic_tone, 'galactic_tone debe coincidir');
      assert(apiData.wavespell_id === dbKin.wavespell_id, 'wavespell_id debe coincidir');
      assert(apiData.castle_id === dbKin.castle_id, 'castle_id debe coincidir');

    } catch (error) {
      logTest(`Kin ${kinNumber}: API ↔ DB`, 'FAIL', error.message);
    }
  }

  logStep(`Resultado: ${passedCount}/${totalCount} Kins verificados correctamente`);
  assert(passedCount === totalCount, `Todos los Kins deben ser consistentes`);
}

async function test2_TodayEndpointConsistency() {
  logStep('TEST 2: Consistencia de endpoint /calendar/today');

  try {
    const apiResponse = await axios.get(`${API_BASE_URL}/calendar/today`);
    const apiKin = apiResponse.data.kin.kin || apiResponse.data.kin;
    const apiKinNumber = apiKin.kin_number;
    
    const dbKin = db.prepare('SELECT * FROM kins WHERE kin_number = ?').get(apiKinNumber);

    if (!dbKin) {
      logTest('Today Endpoint: API ↔ DB', 'FAIL', 'Kin de hoy no encontrado en DB');
      return;
    }

    const mismatches = compareWithDatabase(apiKin, dbKin, 'today_kin');

    if (mismatches.length === 0) {
      logTest('Today Endpoint: API ↔ DB', 'PASS', 'Datos de hoy completamente consistentes');
    } else {
      logTest('Today Endpoint: API ↔ DB', 'FAIL', `Inconsistencias: ${mismatches.length}`);
      mismatches.forEach(m => {
        console.log(`   Campo ${m.field}: API="${m.apiValue}" vs DB="${m.dbValue}"`);
      });
    }

    assert(apiKin.kin_number === dbKin.kin_number, 'kin_number debe coincidir');
    assert(apiKin.solar_seal === dbKin.solar_seal, 'solar_seal debe coincidir');
    assert(apiKin.galactic_tone === dbKin.galactic_tone, 'galactic_tone debe coincidir');

  } catch (error) {
    logTest('Today Endpoint: API ↔ DB', 'FAIL', error.message);
    throw error;
  }
}

async function test3_RelationalIntegrity() {
  logStep('TEST 3: Integridad referencial de Kins, Wavespells y Castles');

  try {
    const dbKins = db.prepare('SELECT * FROM kins LIMIT 20').all();
    let passedCount = 0;

    for (const kin of dbKins) {
      const apiResponse = await axios.get(`${API_BASE_URL}/calendar/oracle/${kin.kin_number}`);
      const apiData = apiResponse.data.oracle.destiny;

      const dbWavespell = db.prepare('SELECT * FROM wavespells WHERE id = ?').get(kin.wavespell_id);
      const dbCastle = db.prepare('SELECT * FROM castles WHERE id = ?').get(kin.castle_id);

      if (!dbWavespell) {
        logTest(`Kin ${kin.kin_number}: Integridad Referencial`, 'FAIL', 'wavespell_id no existe en DB');
        continue;
      }

      if (!dbCastle) {
        logTest(`Kin ${kin.kin_number}: Integridad Referencial`, 'FAIL', 'castle_id no existe en DB');
        continue;
      }

      // Verificar IDs en lugar de objetos anidados
      if (apiData.wavespell_id && apiData.castle_id) {
        assert(apiData.wavespell_id === dbWavespell.id, 'wavespell_id debe coincidir');
        assert(apiData.castle_id === dbCastle.id, 'castle_id debe coincidir');
        logTest(`Kin ${kin.kin_number}: Integridad Referencial`, 'PASS', 'Foreign keys válidos');
        passedCount++;
      } else {
        logTest(`Kin ${kin.kin_number}: Integridad Referencial`, 'FAIL', 'API no devuelve wavespell_id/castle_id');
      }
    }

    logStep(`Resultado: ${passedCount}/${dbKins.length} Kins con integridad referencial correcta`);
    assert(passedCount === dbKins.length, 'Todos los Kins deben tener integridad referencial');

  } catch (error) {
    logTest('Integridad Referencial', 'FAIL', error.message);
    throw error;
  }
}

async function test4_CacheConsistency() {
  logStep('TEST 4: Consistencia de caché (mismas peticiones, mismos datos)');

  try {
    const kinNumber = 1;

    const response1 = await axios.get(`${API_BASE_URL}/calendar/oracle/${kinNumber}`);
    const response2 = await axios.get(`${API_BASE_URL}/calendar/oracle/${kinNumber}`);

    const json1 = JSON.stringify(response1.data);
    const json2 = JSON.stringify(response2.data);

    if (json1 === json2) {
      logTest('Cache Consistency', 'PASS', 'Misma respuesta en múltiples llamadas');
    } else {
      logTest('Cache Consistency', 'FAIL', 'Respuestas diferentes');
    }

    assert(json1 === json2, 'Respuestas idénticas deben ser consistentes');

  } catch (error) {
    logTest('Cache Consistency', 'FAIL', error.message);
    throw error;
  }
}

async function test5_CompleteOracleStructure() {
  logStep('TEST 5: Estructura completa de Oracle tiene todos los campos requeridos');

  try {
    const kinNumber = 260;
    const response = await axios.get(`${API_BASE_URL}/calendar/oracle/${kinNumber}`);
    const oracle = response.data.oracle;

    const requiredFields = ['destiny', 'analog', 'antipode', 'occult', 'guide'];
    const requiredDestinyFields = ['kin_number', 'solar_seal', 'solar_seal_es', 'galactic_tone', 
                                     'galactic_tone_name', 'color', 'color_es', 'power', 'power_es',
                                     'action', 'action_es', 'essence', 'essence_es', 'wavespell_id', 'castle_id'];

    let missingFields = [];

    requiredFields.forEach(field => {
      if (!oracle[field]) {
        missingFields.push(`oracle.${field}`);
      }
    });

    requiredDestinyFields.forEach(field => {
      if (!oracle.destiny || oracle.destiny[field] === undefined) {
        missingFields.push(`destiny.${field}`);
      }
    });

    if (missingFields.length === 0) {
      logTest('Oracle Structure', 'PASS', 'Todos los campos requeridos presentes');
    } else {
      logTest('Oracle Structure', 'FAIL', `Campos faltantes: ${missingFields.join(', ')}`);
    }

    assert(missingFields.length === 0, 'Todos los campos requeridos deben estar presentes');

  } catch (error) {
    logTest('Oracle Structure', 'FAIL', error.message);
    throw error;
  }
}

async function runAllTests() {
  console.log('\n========================================');
  console.log('🔬 INTEGRITY TESTS: API ↔ DATABASE');
  console.log('========================================');
  console.log('⚠️  CRÍTICO: 100% DATOS REALES - NINGÚN MOCK');
  console.log('========================================\n');

  const apiRunning = await checkAPIRunning();
  if (!apiRunning) {
    console.error('❌ ERROR: API REST no está corriendo en localhost:8000');
    console.log('   Inicia el servidor: cd backend && php artisan serve');
    process.exit(1);
  }

  console.log('✅ API REST está corriendo');
  console.log('📊 Conectando a base de datos real...\n');

  try {
    db = new Database(DB_PATH, { readonly: true });
    console.log('✅ Conexión a base de datos SQLite establecida\n');

    const tests = [
      test1_KinDataConsistency,
      test2_TodayEndpointConsistency,
      test3_RelationalIntegrity,
      test4_CacheConsistency,
      test5_CompleteOracleStructure
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
      console.log('✅ TODOS LOS TESTS DE INTEGRIDAD PASARON');
      console.log('✅ API ↔ Base de Datos 100% CONSISTENTES');
      console.log('✅ DATOS 100% REALES - SIN MOCKS');
    } else {
      console.log('❌ ALGUNOS TESTS FALLARON - REVISAR DETALLES');
      process.exit(1);
    }

  } catch (error) {
    console.error('\n❌ ERROR CRÍTICO:', error.message);
    process.exit(1);
  } finally {
    if (db) db.close();
  }
}

if (import.meta.url === `file://${process.argv[1]}`) {
  runAllTests();
}

export {
  runAllTests,
  test1_KinDataConsistency,
  test2_TodayEndpointConsistency,
  test3_RelationalIntegrity,
  test4_CacheConsistency,
  test5_CompleteOracleStructure
};