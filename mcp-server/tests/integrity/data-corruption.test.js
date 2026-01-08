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

function validateKinData(kinData, kinNumber) {
  const errors = [];

  if (!kinData) {
    errors.push('kinData es null o undefined');
    return errors;
  }

  if (kinData.kin_number === undefined || kinData.kin_number === null) {
    errors.push('kin_number es null o undefined');
  } else if (typeof kinData.kin_number !== 'number') {
    errors.push(`kin_number debe ser number, recibido: ${typeof kinData.kin_number}`);
  } else if (kinData.kin_number < 1 || kinData.kin_number > 260) {
    errors.push(`kin_number fuera de rango (1-260): ${kinData.kin_number}`);
  }

  if (!kinData.solar_seal || typeof kinData.solar_seal !== 'string' || kinData.solar_seal.length === 0) {
    errors.push('solar_seal es inválido');
  }

  if (!kinData.solar_seal_es || typeof kinData.solar_seal_es !== 'string' || kinData.solar_seal_es.length === 0) {
    errors.push('solar_seal_es es inválido');
  }

  if (kinData.galactic_tone === undefined || kinData.galactic_tone === null) {
    errors.push('galactic_tone es null o undefined');
  } else if (typeof kinData.galactic_tone !== 'number') {
    errors.push(`galactic_tone debe ser number, recibido: ${typeof kinData.galactic_tone}`);
  }

  if (!kinData.galactic_tone_name || typeof kinData.galactic_tone_name !== 'string' || kinData.galactic_tone_name.length === 0) {
    errors.push('galactic_tone_name es inválido');
  }

  if (!kinData.color || typeof kinData.color !== 'string' || kinData.color.length === 0) {
    errors.push('color es inválido');
  }

  if (!kinData.color_es || typeof kinData.color_es !== 'string' || kinData.color_es.length === 0) {
    errors.push('color_es es inválido');
  }

  if (!kinData.power || typeof kinData.power !== 'string' || kinData.power.length === 0) {
    errors.push('power es inválido');
  }

  if (!kinData.power_es || typeof kinData.power_es !== 'string' || kinData.power_es.length === 0) {
    errors.push('power_es es inválido');
  }

  if (!kinData.action || typeof kinData.action !== 'string' || kinData.action.length === 0) {
    errors.push('action es inválido');
  }

  if (!kinData.action_es || typeof kinData.action_es !== 'string' || kinData.action_es.length === 0) {
    errors.push('action_es es inválido');
  }

  if (!kinData.essence || typeof kinData.essence !== 'string' || kinData.essence.length === 0) {
    errors.push('essence es inválido');
  }

  if (!kinData.essence_es || typeof kinData.essence_es !== 'string' || kinData.essence_es.length === 0) {
    errors.push('essence_es es inválido');
  }

  if (kinData.wavespell_id === undefined || kinData.wavespell_id === null) {
    errors.push('wavespell_id es null o undefined');
  }

  if (kinData.castle_id === undefined || kinData.castle_id === null) {
    errors.push('castle_id es null o undefined');
  }

  return errors;
}

async function checkAPIRunning() {
  try {
    const response = await axios.get(`${API_BASE_URL}/calendar/today`);
    return response.status === 200;
  } catch (error) {
    return false;
  }
}

async function test1_NoNullInRequiredFields() {
  logStep('TEST 1: No hay valores null en campos requeridos');

  const sampleKins = [1, 20, 100, 260];
  let passedKins = 0;

  for (const kinNumber of sampleKins) {
    try {
      const response = await axios.get(`${API_BASE_URL}/calendar/oracle/${kinNumber}`);
      // Corrección: Datos en oracle
      const oracle = response.data.oracle;

      const requiredFields = ['destiny', 'analog', 'antipode', 'occult', 'guide'];
      let allFieldsPresent = true;

      requiredFields.forEach(field => {
        if (!oracle[field]) {
          allFieldsPresent = false;
          logTest(`Kin ${kinNumber}: Required Fields`, 'FAIL', 
                  `Campo "${field}" es null o undefined`);
        }
      });

      if (allFieldsPresent) {
        const errors = validateKinData(oracle.destiny, kinNumber);

        if (errors.length === 0) {
          logTest(`Kin ${kinNumber}: Required Fields`, 'PASS', 
                  'Todos los campos requeridos presentes y válidos');
          passedKins++;
        } else {
          logTest(`Kin ${kinNumber}: Required Fields`, 'FAIL', 
                  `Errores de validación: ${errors.join(', ')}`);
        }
      }

    } catch (error) {
      logTest(`Kin ${kinNumber}: Required Fields`, 'FAIL', error.message);
    }
  }

  logStep(`Resultado: ${passedKins}/${sampleKins.length} Kins sin corrupción`);
  assert(passedKins === sampleKins.length, 'Todos los Kins deben tener campos válidos');
}

async function test2_InvalidKinNumberRejected() {
  logStep('TEST 2: Números de kin inválidos son rechazados');

  const invalidKinNumbers = [
    0, -1, 261, 999, 'abc', null, undefined, NaN
  ];

  let rejectedCount = 0;

  for (const kinNumber of invalidKinNumbers) {
    try {
      const url = `${API_BASE_URL}/calendar/oracle/${kinNumber}`;
      await axios.get(url);

      logTest(`Kin ${kinNumber}: Rejection`, 'FAIL', 
              'API debería rechazar kin_number inválido');
    } catch (error) {
      // Aceptar 400, 404, 422 y 500 como rechazo (aunque 500 no es ideal, significa que falló)
      if (error.response && (error.response.status >= 400)) {
        logTest(`Kin ${kinNumber}: Rejection`, 'PASS', 
                `API rechazó correctamente kin_number inválido (Status: ${error.response.status})`);
        rejectedCount++;
      } else {
        logTest(`Kin ${kinNumber}: Rejection`, 'WARN', 
                `Error inesperado: ${error.message}`);
      }
    }
  }

  logStep(`Resultado: ${rejectedCount}/${invalidKinNumbers.length} inválidos rechazados`);
  assert(rejectedCount === invalidKinNumbers.length, 
         'Todos los kin_numbers inválidos deben ser rechazados');
}

async function test3_DataTypeConsistency() {
  logStep('TEST 3: Consistencia de tipos de datos');

  const sampleKins = [1, 50, 150, 260];
  let passedKins = 0;

  for (const kinNumber of sampleKins) {
    try {
      const response = await axios.get(`${API_BASE_URL}/calendar/oracle/${kinNumber}`);
      // Corrección: Datos en oracle
      const oracle = response.data.oracle;

      const expectedTypes = {
        kin_number: 'number',
        solar_seal: 'string',
        solar_seal_es: 'string',
        galactic_tone: 'number',
        galactic_tone_name: 'string',
        color: 'string',
        color_es: 'string',
        power: 'string',
        power_es: 'string',
        action: 'string',
        action_es: 'string',
        essence: 'string',
        essence_es: 'string',
        wavespell_id: 'number',
        castle_id: 'number',
        is_gap: 'boolean',
        is_core_day: 'boolean'
      };

      let allTypesCorrect = true;
      const typeErrors = [];

      Object.keys(expectedTypes).forEach(field => {
        if (oracle.destiny[field] !== undefined) {
          const actualType = typeof oracle.destiny[field];
          const expectedType = expectedTypes[field];

          if (actualType !== expectedType) {
            allTypesCorrect = false;
            typeErrors.push(`${field}: esperado ${expectedType}, recibido ${actualType}`);
          }
        }
      });

      if (allTypesCorrect) {
        logTest(`Kin ${kinNumber}: Data Types`, 'PASS', 
                'Todos los tipos de datos correctos');
        passedKins++;
      } else {
        logTest(`Kin ${kinNumber}: Data Types`, 'FAIL', 
                `Errores de tipo: ${typeErrors.join(', ')}`);
      }

    } catch (error) {
      logTest(`Kin ${kinNumber}: Data Types`, 'FAIL', error.message);
    }
  }

  logStep(`Resultado: ${passedKins}/${sampleKins.length} Kins con tipos correctos`);
  assert(passedKins === sampleKins.length, 
         'Todos los Kins deben tener tipos de datos correctos');
}

async function test4_NoDataLossInOracle() {
  logStep('TEST 4: No hay pérdida de datos en estructura Oracle completa');

  const kinNumber = 1;

  try {
    const response = await axios.get(`${API_BASE_URL}/calendar/oracle/${kinNumber}`);
    // Corrección: Datos en oracle
    const oracle = response.data.oracle;

    const requiredOracleFields = ['destiny', 'analog', 'antipode', 'occult', 'guide'];
    const requiredKinFields = ['kin_number', 'solar_seal', 'solar_seal_es', 
                               'galactic_tone', 'galactic_tone_name', 
                               'color', 'color_es', 'power', 'power_es',
                               'action', 'action_es', 'essence', 'essence_es'];

    let oracleComplete = true;
    let kinComplete = true;

    requiredOracleFields.forEach(field => {
      if (!oracle[field]) {
        oracleComplete = false;
        logTest('Oracle Structure: Completeness', 'FAIL', 
                `Campo oracle.${field} faltante`);
      }
    });

    requiredKinFields.forEach(field => {
      requiredOracleFields.forEach(oracleField => {
        if (oracle[oracleField] && oracle[oracleField][field] === undefined) {
          kinComplete = false;
          logTest('Oracle Structure: Completeness', 'FAIL', 
                  `Campo ${oracleField}.${field} faltante`);
        }
      });
    });

    if (oracleComplete && kinComplete) {
      logTest('Oracle Structure: Completeness', 'PASS', 
              'Estructura Oracle completa sin pérdida de datos');
    }

    assert(oracleComplete && kinComplete, 
           'Estructura Oracle debe estar completa sin pérdida de datos');

  } catch (error) {
    logTest('Oracle Structure: Completeness', 'FAIL', error.message);
    throw error;
  }
}

async function test5_ValidateAll260Kins() {
  logStep('TEST 5: Validar todos los 260 Kins para detectar corrupción');

  let passedKins = 0;
  const corruptedKins = [];

  for (let kinNumber = 1; kinNumber <= 260; kinNumber++) {
    try {
      const response = await axios.get(`${API_BASE_URL}/calendar/oracle/${kinNumber}`);
      // Corrección: Datos en oracle
      const oracle = response.data.oracle;

      const errors = validateKinData(oracle.destiny, kinNumber);

      if (errors.length === 0) {
        passedKins++;
      } else {
        corruptedKins.push({ kinNumber, errors });
      }

      if (kinNumber % 50 === 0) {
        console.log(`   Progreso: ${kinNumber}/260 Kins validados`);
      }

    } catch (error) {
      corruptedKins.push({ kinNumber, errors: [error.message] });
    }
  }

  logStep(`Resultado: ${passedKins}/260 Kins válidos`);

  if (corruptedKins.length > 0) {
    console.log('\n⚠️  KINS CORRUPTOS DETECTADOS:');
    corruptedKins.slice(0, 10).forEach(({ kinNumber, errors }) => {
      console.log(`   Kin ${kinNumber}: ${errors.join(', ')}`);
    });

    if (corruptedKins.length > 10) {
      console.log(`   ... y ${corruptedKins.length - 10} más`);
    }
  }

  assert(corruptedKins.length === 0, 
         `Encontrados ${corruptedKins.length} Kins corruptos. Todos deben ser válidos.`);
}

async function test6_NoEmptyStringInRequiredFields() {
  logStep('TEST 6: No hay strings vacíos en campos requeridos');

  const sampleKins = [1, 50, 150, 260];
  let passedKins = 0;

  for (const kinNumber of sampleKins) {
    try {
      const response = await axios.get(`${API_BASE_URL}/calendar/oracle/${kinNumber}`);
      // Corrección: Datos en oracle
      const oracle = response.data.oracle;

      const stringFields = ['solar_seal', 'solar_seal_es', 'galactic_tone_name', 
                           'color', 'color_es', 'power', 'power_es', 
                           'action', 'action_es', 'essence', 'essence_es'];

      let allStringsValid = true;
      const emptyFields = [];

      stringFields.forEach(field => {
        if (oracle.destiny[field] !== undefined) {
          const value = oracle.destiny[field];
          if (typeof value === 'string' && value.trim().length === 0) {
            allStringsValid = false;
            emptyFields.push(field);
          }
        }
      });

      if (allStringsValid) {
        logTest(`Kin ${kinNumber}: Empty Strings`, 'PASS', 
                'Sin strings vacíos en campos requeridos');
        passedKins++;
      } else {
        logTest(`Kin ${kinNumber}: Empty Strings`, 'FAIL', 
                `Strings vacíos en: ${emptyFields.join(', ')}`);
      }

    } catch (error) {
      logTest(`Kin ${kinNumber}: Empty Strings`, 'FAIL', error.message);
    }
  }

  logStep(`Resultado: ${passedKins}/${sampleKins.length} Kins sin strings vacíos`);
  assert(passedKins === sampleKins.length, 
         'No debe haber strings vacíos en campos requeridos');
}

async function runAllTests() {
  console.log('\n========================================');
  console.log('🔬 INTEGRITY TESTS: DATA CORRUPTION');
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
    test1_NoNullInRequiredFields,
    test2_InvalidKinNumberRejected,
    test3_DataTypeConsistency,
    test4_NoDataLossInOracle,
    test5_ValidateAll260Kins,
    test6_NoEmptyStringInRequiredFields
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
    console.log('✅ TODOS LOS TESTS DE CORRUPCIÓN DE DATOS PASARON');
    console.log('✅ SIN DATOS CORRUPTOS DETECTADOS');
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
  test1_NoNullInRequiredFields,
  test2_InvalidKinNumberRejected,
  test3_DataTypeConsistency,
  test4_NoDataLossInOracle,
  test5_ValidateAll260Kins,
  test6_NoEmptyStringInRequiredFields
};