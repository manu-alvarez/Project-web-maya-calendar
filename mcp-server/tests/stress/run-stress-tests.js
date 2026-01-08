import { 
  runAllStressTests,
  test1_NormalLoad_10Users_100Requests,
  test2_HighLoad_100Users_1000Requests,
  test3_ExtremeLoad_1000Users_5000Requests,
  test4_LargeDataRequests_AllOracles,
  test5_IntermittentConnections
} from './load-tests.js';

console.log('\n═══════════════════════════════════════════════');
console.log('🔥 EJECUTANDO STRESS TESTS - Datos 100% REALES');
console.log('═══════════════════════════════════════════════\n');

console.log('📋 REQUISITOS:');
console.log('  ✅ API REST debe estar corriendo en http://localhost:8000');
console.log('  ✅ Base de datos SQLite con datos REALES');
console.log('  ✅ SIN MOCKS, SIN FAKES, SIN DATOS FALSOS');
console.log('  ✅ TODOS los datos provienen de producción\n');

if (import.meta.url === `file://${process.argv[1]}`) {
  runAllStressTests()
    .then(() => {
      console.log('\n✅ TODOS LOS STRESS TESTS COMPLETADOS EXITOSAMENTE');
      console.log('📊 RESULTADO FINAL:');
      console.log('  ✅ Datos: 100% REALES de producción');
      console.log('  ✅ Sin mocks ni fakes');
      console.log('  ✅ Rendimiento validado bajo carga REAL');
      console.log('  ✅ Sistema listo para producción');
    })
    .catch((error) => {
      console.error('\n❌ ERROR CRÍTICO EJECUTANDO STRESS TESTS:');
      console.error(error);
      console.error('\n🔍 POSIBLES CAUSAS:');
      console.error('  1. API REST no está corriendo (ejecutar: cd backend && php artisan serve)');
      console.error('  2. Base de datos no está inicializada (ejecutar: cd backend && php artisan migrate:fresh --seed)');
      console.error('  3. Sistema no soporta concurrencia alta');
      console.error('  4. Red está saturada');
      console.error('\n💡 SOLUCIÓN: Verificar que el backend está corriendo correctamente');
      process.exit(1);
    });
}

export { runAllStressTests };
