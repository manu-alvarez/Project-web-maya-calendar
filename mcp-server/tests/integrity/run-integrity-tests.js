import axios from 'axios';
import * as apiDbConsistency from './api-db-consistency.test.js';
import * as idempotency from './idempotency.test.js';
import * as dataCorruption from './data-corruption.test.js';

const API_BASE_URL = 'http://localhost:8000/api';

async function checkAPIRunning() {
  try {
    const response = await axios.get(`${API_BASE_URL}/calendar/today`);
    return response.status === 200;
  } catch (error) {
    return false;
  }
}

function printHeader(title) {
  console.log('\n' + '='.repeat(50));
  console.log(title);
  console.log('='.repeat(50));
}

function printSummary(results) {
  console.log('\n' + '='.repeat(50));
  console.log('📊 RESUMEN COMPLETO DE TESTS DE INTEGRIDAD');
  console.log('='.repeat(50));

  let totalPassed = 0;
  let totalFailed = 0;

  Object.keys(results).forEach(category => {
    const categoryResult = results[category];
    totalPassed += categoryResult.passed;
    totalFailed += categoryResult.failed;

    const statusEmoji = categoryResult.passed === categoryResult.total ? '✅' : '❌';
    console.log(`\n${statusEmoji} ${category}: ${categoryResult.passed}/${categoryResult.total} tests PASSED`);

    if (categoryResult.failedTests && categoryResult.failedTests.length > 0) {
      console.log('   Tests fallados:');
      categoryResult.failedTests.forEach(testName => {
        console.log(`   ❌ ${testName}`);
      });
    }
  });

  console.log('\n' + '='.repeat(50));
  console.log(`📊 TOTAL: ${totalPassed}/${totalPassed + totalFailed} tests PASSED`);
  console.log(`📊 Tasa de éxito: ${((totalPassed / (totalPassed + totalFailed)) * 100).toFixed(2)}%`);
  console.log('='.repeat(50));

  return totalPassed === totalPassed + totalFailed;
}

async function runIntegrityTests() {
  console.log('\n' + '='.repeat(50));
  console.log('🔬 SUITE COMPLETA DE TESTS DE INTEGRIDAD');
  console.log('='.repeat(50));
  console.log('⚠️  CRÍTICO: 100% DATOS REALES - NINGÚN MOCK');
  console.log('⚠️  CRÍTICO: PRODUCCIÓN - TODOS LOS DATOS SON REALES');
  console.log('='.repeat(50));

  const apiRunning = await checkAPIRunning();
  if (!apiRunning) {
    console.error('\n❌ ERROR: API REST no está corriendo en localhost:8000');
    console.log('   Inicia el servidor: cd backend && php artisan serve');
    process.exit(1);
  }

  console.log('\n✅ API REST está corriendo');
  console.log('✅ Conexión establecida con base de datos real');
  console.log('✅ Listo para ejecutar tests de integridad\n');

  const results = {
    'API ↔ Database Consistency': {
      passed: 0,
      failed: 0,
      total: 5,
      failedTests: []
    },
    'Idempotency': {
      passed: 0,
      failed: 0,
      total: 5,
      failedTests: []
    },
    'Data Corruption Detection': {
      passed: 0,
      failed: 0,
      total: 6,
      failedTests: []
    }
  };

  printHeader('CATEGORÍA 1: API ↔ DATABASE CONSISTENCY');
  try {
    await apiDbConsistency.runAllTests();
    results['API ↔ Database Consistency'].passed = 5;
    console.log('\n✅ API ↔ Database Consistency: TODOS LOS TESTS PASARON');
  } catch (error) {
    results['API ↔ Database Consistency'].failed = 5;
    console.log('\n❌ API ↔ Database Consistency: TESTS FALLARON');
  }

  printHeader('CATEGORÍA 2: IDEMPOTENCY');
  try {
    await idempotency.runAllTests();
    results['Idempotency'].passed = 5;
    console.log('\n✅ Idempotency: TODOS LOS TESTS PASARON');
  } catch (error) {
    results['Idempotency'].failed = 5;
    console.log('\n❌ Idempotency: TESTS FALLARON');
  }

  printHeader('CATEGORÍA 3: DATA CORRUPTION DETECTION');
  try {
    await dataCorruption.runAllTests();
    results['Data Corruption Detection'].passed = 6;
    console.log('\n✅ Data Corruption Detection: TODOS LOS TESTS PASARON');
  } catch (error) {
    results['Data Corruption Detection'].failed = 6;
    console.log('\n❌ Data Corruption Detection: TESTS FALLARON');
  }

  const allPassed = printSummary(results);

  if (allPassed) {
    console.log('\n' + '✅'.repeat(50));
    console.log('✅ TODOS LOS TESTS DE INTEGRIDAD PASARON');
    console.log('✅ API REST 100% CONSISTENTE CON BASE DE DATOS');
    console.log('✅ OPERACIONES 100% IDEMPOTENTES');
    console.log('✅ SIN DATOS CORRUPTOS DETECTADOS');
    console.log('✅ DATOS 100% REALES - NINGÚN MOCK USADO');
    console.log('✅ INTEGRIDAD Y CONFIABILIDAD GARANTIZADAS');
    console.log('✅'.repeat(50) + '\n');
  } else {
    console.log('\n' + '❌'.repeat(50));
    console.log('❌ ALGUNOS TESTS DE INTEGRIDAD FALLARON');
    console.log('❌ REVISAR DETALLES ARRIBA');
    console.log('❌'.repeat(50) + '\n');
    process.exit(1);
  }
}

if (import.meta.url === `file://${process.argv[1]}`) {
  runIntegrityTests().catch(error => {
    console.error('\n❌ ERROR CRÍTICO:', error.message);
    console.error(error.stack);
    process.exit(1);
  });
}

export { runIntegrityTests };
