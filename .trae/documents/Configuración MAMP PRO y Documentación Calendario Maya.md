# Plan de Configuración MAMP PRO y Documentación

## Objetivos
1. Configurar Composer para trabajar con PHP de MAMP
2. Crear guía de referencia del calendario sincronizador maya
3. Documentar configuración de MAMP para el proyecto
4. Actualizar dependencias críticas y commitear cambios

## Pasos a Ejecutar

### Paso 1: Configurar Composer
- Crear script wrapper de Composer que use PHP de MAMP
- Verificar instalación de Composer funciona correctamente
- Testear `composer --version` con PHP 8.2 de MAMP

### Paso 2: Crear Documento de Guía
- Crear `/resources/maya-calendar-guide.md` con:
  - Explicación clara del calendario sincronizador maya
  - Mecánica y funcionamiento del sistema
  - Conceptos fundamentales (Kin, Tono, Sello, Oráculo, Onda, Castillo)
  - Diagramas y ejemplos prácticos
  - Tablas de referencia (Tonos, Sellos, Colores)
  - Guía paso a paso para cálculos

### Paso 3: Documentar Configuración MAMP
- Crear `/LOGS/mamp-setup.md` con:
  - Versiones verificadas de todos los servicios
  - Rutas de ejecutables
  - Credenciales de MySQL (solo placeholders en .env.example)
  - Instrucciones para usar PHP de MAMP en proyectos Laravel

### Paso 4: Actualizar Dependencias Críticas
- Marcar BLOQUEANTE-7 como COMPLETED
- Actualizar checklist en `/plan/critical-dependencies.md`
- Documentar que entorno está listo para desarrollo

### Paso 5: Commits
- Commit: "Configure Composer for MAMP PHP 8.2 and document MAMP setup"
- Commit: "Add comprehensive Maya calendar synchronization guide with mechanics and reference tables"
- Commit: "Update critical dependencies - MAMP environment fully configured"

## Resultados Esperados
- ✅ Composer funcionando con PHP 8.2 de MAMP
- ✅ Guía completa del calendario maya para referencia
- ✅ Documentación de configuración MAMP
- ✅ Todas las dependencias críticas actualizadas
- ✅ Entorno listo para comenzar instalación de frontend y backend