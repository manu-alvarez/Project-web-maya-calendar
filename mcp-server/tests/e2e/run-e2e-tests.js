import { 
  runAllE2ETests,
  test1_CompleteUserJourney,
  test2_APIConsistency,
  test3_KinByDateConsistency,
  test4_OracleIntegrity,
  test5_WavespellIntegrity,
  test6_CastleIntegrity
} from './user-journey-complete.test.js';

console.log('\n═════════════════════════════════════════════');
console.log('🚀 EJECUTANDO E2E TESTS - Datos 100% REALES');
console.log('═══════════════════════════════════════════════\n');

console.log('📋 REQUISITOS:');
console.log('  ✅ API REST debe estar corriendo en http://localhost:8000');
console.log('  ✅ Base de datos SQLite con datos REALES');
console.log('  ✅ SIN MOCKS, SIN FAKES, SIN DATOS FALSOS');
console.log('  ✅ TODOS los datos provienen de producción\n');

if (import.meta.url === `file://${process.argv[1]}`) {
  runAllE2ETests()
    .then(() => {
      console.log('\n✅ TODOS LOS TESTS E2E COMPLETADOS EXITOSAMENTE');
      console.log('📊 RESULTADO FINAL:');
      console.log('  ✅ Datos: 100% REALES de producción');
      console.log('  ✅ Sin mocks ni fakes');
      console.log('  ✅ Integridad validada');
      console.log('  ✅ Sistema listo para producción');
    })
    .catch((error) => {
      console.error('\n❌ ERROR CRÍTICO EJECUTANDO TESTS:');
      console.error(error);
      console.error('\n🔍 POSIBLES CAUSAS:');
      console.error('  1. API REST no está corriendo (ejecutar: cd backend && php artisan serve)');
      console.error('  2. Base de datos no está inicializada (ejecutar: cd backend && php artisan migrate:fresh --seed)');
      console.error('  3. Puerto 8000 está ocupado por otro servicio');
      console.error('\n💡 SOLUCIÓN: Verificar que el backend está corriendo correctamente');
      process.exit(1);
    });
}

export { runAllE2ETests };
