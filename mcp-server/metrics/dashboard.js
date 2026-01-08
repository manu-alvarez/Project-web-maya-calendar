const { 
  getMetrics,
  getAlerts
} = require('./collector.js');

function displayDashboard() {
  console.log('\n═══════════════════════════════════════════════');
  console.log('📊 DASHBOARD DE MÉTRICAS REALES - Maya Calendar MCP');
  console.log('═════════════════════════════════════════════════\n');
  
  const metrics = getMetrics();
  const alerts = getAlerts();
  
  displaySummary(metrics);
  displayByTool(metrics);
  displayByPlatform(metrics);
  displayAlerts(alerts);
  
  console.log('\n═════════════════════════════════════════════════');
  console.log('📁 TODAS las métricas son 100% REALES de producción');
  console.log('═══════════════════════════════════════════════════\n');
}

function displaySummary(metrics) {
  console.log('📈 RESUMEN GLOBAL:');
  console.log('─────────────────────────────────────────────────────────────────');
  console.log(`  Total Requests:         ${metrics.summary.total_requests}`);
  console.log(`  Successful Requests:     ${metrics.summary.successful_requests} (${metrics.summary.success_rate}%)`);
  console.log(`  Failed Requests:         ${metrics.summary.failed_requests} (${metrics.summary.error_rate}%)`);
  console.log(`  Average Latency:        ${metrics.summary.average_latency.toFixed(0)}ms`);
  console.log(`  P50 Latency:           ${metrics.summary.p50_latency.toFixed(0)}ms`);
  console.log(`  P95 Latency:           ${metrics.summary.p95_latency.toFixed(0)}ms`);
  console.log(`  P99 Latency:           ${metrics.summary.p99_latency.toFixed(0)}ms`);
  console.log(`  Requests/Second:        ${metrics.summary.requests_per_second.toFixed(0)}`);
  console.log('─────────────────────────────────────────────────────────────────\n');
  
  const successRate = parseFloat(metrics.summary.success_rate);
  const p95Latency = metrics.summary.p95_latency;
  const p99Latency = metrics.summary.p99_latency;
  
  if (successRate >= 99) {
    console.log('✅ EXCELENTE: Tasa de éxito >= 99%');
  } else if (successRate >= 95) {
    console.log('⚠️  BUENO: Tasa de éxito >= 95%');
  } else {
    console.log('❌ CRÍTICO: Tasa de éxito < 95%');
  }
  
  if (p95Latency <= 500) {
    console.log('✅ EXCELENTE: Latencia p95 <= 500ms');
  } else if (p95Latency <= 1000) {
    console.log('⚠️  ACEPTABLE: Latencia p95 <= 1000ms');
  } else {
    console.log('❌ CRÍTICO: Latencia p95 > 1000ms');
  }
}

function displayByTool(metrics) {
  console.log('🛠 MÉTRICAS POR HERRAMIENTA:');
  console.log('─────────────────────────────────────────────────────────────────');
  
  const tools = Object.entries(metrics.by_tool);
  if (tools.length === 0) {
    console.log('  (Sin datos aún)');
    console.log('─────────────────────────────────────────────────────────────────\n');
    return;
  }
  
  tools.sort(([, a], [, b]) => b.total_calls - a.total_calls).forEach(([toolName, data]) => {
    const successRate = parseFloat(data.success_rate);
    const avgLatency = data.average_latency;
    const successEmoji = successRate >= 99 ? '✅' : (successRate >= 95 ? '⚠️' : '❌');
    
    console.log(`  ${toolName}:`);
    console.log(`    Llamadas:          ${data.total_calls}`);
    console.log(`    Exitosas:           ${data.successful_calls} (${data.success_rate}%) ${successEmoji}`);
    console.log(`    Fallidas:           ${data.failed_calls}`);
    console.log(`    Promedio Latencia:   ${avgLatency.toFixed(0)}ms`);
  });
  
  console.log('─────────────────────────────────────────────────────────────────\n');
}

function displayByPlatform(metrics) {
  console.log('📱 MÉTRICAS POR PLATAFORMA:');
  console.log('─────────────────────────────────────────────────────────────────');
  
  const platforms = Object.entries(metrics.by_platform);
  if (platforms.length === 0) {
    console.log('  (Sin datos aún)');
    console.log('─────────────────────────────────────────────────────────────────\n');
    return;
  }
  
  platforms.sort(([, a], [, b]) => b.total_calls - a.total_calls).forEach(([platform, data]) => {
    const successRate = parseFloat(data.success_rate);
    const avgLatency = data.average_latency;
    const successEmoji = successRate >= 99 ? '✅' : (successRate >= 95 ? '⚠️' : '❌');
    
    console.log(`  ${platform}:`);
    console.log(`    Llamadas:          ${data.total_calls}`);
    console.log(`    Exitosas:           ${data.successful_calls} (${data.success_rate}%) ${successEmoji}`);
    console.log(`    Promedio Latencia:   ${avgLatency.toFixed(0)}ms`);
  });
  
  console.log('─────────────────────────────────────────────────────────────────\n');
}

function displayAlerts(alerts) {
  if (alerts.length === 0) {
    console.log('✅ SIN ALERTAS - Sistema funcionando correctamente\n');
    return;
  }
  
  console.log('⚠️ ALERTAS ACTIVAS:');
  console.log('─────────────────────────────────────────────────────────────────');
  
  const criticalAlerts = alerts.filter(a => a.level === 'CRITICAL');
  const warningAlerts = alerts.filter(a => a.level === 'WARNING');
  
  if (criticalAlerts.length > 0) {
    console.log(`  CRÍTICAS (${criticalAlerts.length}):`);
    criticalAlerts.forEach(alert => {
      console.log(`    ❌ ${alert.type}: ${alert.message}`);
      console.log(`       Valor: ${alert.value} | Umbral: ${alert.threshold}`);
    });
  }
  
  if (warningAlerts.length > 0) {
    console.log(`  ADVERTENCIAS (${warningAlerts.length}):`);
    warningAlerts.forEach(alert => {
      console.log(`    ⚠️  ${alert.type}: ${alert.message}`);
      console.log(`       Valor: ${alert.value} | Umbral: ${alert.threshold}`);
    });
  }
  
  console.log('─────────────────────────────────────────────────────────────────\n');
}

function watchMode() {
  console.log('\n🔄 MODO WATCH ACTIVO - Actualizando cada 5 segundos...\n');
  console.log('Presiona Ctrl+C para salir\n');
  
  let iteration = 0;
  
  const interval = setInterval(() => {
    iteration++;
    console.log(`\n───────────────── ITERACIÓN ${iteration} ─────────────────`);
    
    displayDashboard();
    
    const metrics = getMetrics();
    const alerts = getAlerts();
    
    if (alerts.some(a => a.level === 'CRITICAL')) {
      console.log('\n🔔 ALERTA CRÍTICA DETECTADA - Revisar inmediatamente!');
    }
  }, 5000);
  
  process.on('SIGINT', () => {
    clearInterval(interval);
    console.log('\n\n👋 Saliendo del modo watch...\n');
    process.exit(0);
  });
}

if (require.main === module) {
  const args = process.argv.slice(2);
  
  if (args.includes('--watch') || args.includes('-w')) {
    watchMode();
  } else {
    displayDashboard();
  }
}

module.exports = {
  displayDashboard,
  displaySummary,
  displayByTool,
  displayByPlatform,
  displayAlerts,
  watchMode
};
