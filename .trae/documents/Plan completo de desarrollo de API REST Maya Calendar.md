## Plan Completo de Desarrollo de API REST Maya Calendar

### Estado Actual
✅ **EXISTENTE:**
- Autenticación básica (login, registro, logout, me)
- Google OAuth
- Recuperación de contraseña
- Modelo User básico
- Middleware Sanctum configurado

❌ **FALTANTE:**
- Modelos de Calendario Maya
- Migraciones de datos del calendario
- Controladores de Maya Calendar
- Servicios de cálculo
- Seeders de datos (260 kins)
- Rutas API REST completas
- Validaciones y middleware específicos

---

## FASE 1: Estructura de Base de Datos

### Paso 1.1: Crear Migraciones
- [M01] Migración tabla `kins` (260 kins con sello, tono, color, etc.)
- [M02] Migración tabla `wavespells` (20 ondas encantadas)
- [M03] Migración tabla `castles` (5 castillos)
- [M04] Migración tabla `user_profiles` (perfil extendido de usuario)
- [M05] Migración tabla `user_daily_kins` (registro de kins vistos)
- [M06] Migración tabla `user_oracle_readings` (lecturas de oráculo guardadas)

### Paso 1.2: Crear Modelos Eloquent
- [M07] Modelo Kin con relaciones
- [M08] Modelo Wavespell con relaciones
- [M09] Modelo Castle con relaciones
- [M10] Modelo UserProfile extendido
- [M11] Modelo UserDailyKin
- [M12] Modelo UserOracleReading

### Paso 1.3: Crear Seeders de Datos
- [M13] KinSeeder (260 kins completos con descripciones)
- [M14] WavespellSeeder (20 ondas)
- [M15] CastleSeeder (5 castillos)
- [M16] DatabaseSeeder principal

---

## FASE 2: Servicios de Cálculo

### Paso 2.1: Servicios Core
- [S01] MayaCalculatorService (algoritmos del documento maya-calendar-rules.md)
- [S02] DateConversionService (Gregorian ↔ Maya)
- [S03] OracleCalculationService (5 energías del oráculo)
- [S04] WavespellCalculationService (cálculo de ondas)

### Paso 2.2: Implementación de Algoritmos
- [S05] Implementar cálculo de Kin desde fecha gregoriana
- [S06] Implementar detección de GAP (Galactic Activation Portal)
- [S07] Implementar detección de Core Day (Mystic Column)
- [S08] Implementar cálculo de Castle (5 castillos de 52 días)
- [S09] Implementar cálculo de Wavespell (20 ondas de 13 días)
- [S10] Implementar cálculo de Oracle (5 energías: Destiny, Guide, Analog, Antipode, Occult)

---

## FASE 3: Controladores API

### Paso 3.1: Controladores Principales
- [C01] MayaCalendarController (endpoints generales)
- [C02] KinController (operaciones con kins)
- [C03] WavespellController (operaciones con ondas)
- [C04] CastleController (operaciones con castillos)
- [C05] OracleController (cálculo de oráculos)

### Paso 3.2: Controladores de Usuario
- [C06] UserCalendarController (kin del usuario, historial)
- [C07] UserProfileController (perfil personalizado)
- [C08] UserReadingController (lecturas guardadas)

---

## FASE 4: Rutas API REST

### Paso 4.1: Rutas Públicas (sin autenticación)
- [R01] GET /api/kins/{kinId} - Obtener kin específico
- [R02] GET /api/kins/today - Kin del día actual
- [R03] GET /api/kins/date/{date} - Kin de fecha específica
- [R04] GET /api/wavespells/{wavespellId} - Onda específica
- [R05] GET /api/wavespells/today - Onda del día
- [R06] GET /api/castles/{castleId} - Castillo específico
- [R07] GET /api/castles/today - Castillo del día
- [R08] GET /api/oracles/{kinId} - Oráculo de un kin

### Paso 4.2: Rutas Protegidas (requieren autenticación)
- [R09] GET /api/user/kin-today - Kin del usuario (con personalizaciones)
- [R10] POST /api/user/save-kin - Guardar kin como favorito
- [R11] POST /api/user/save-oracle - Guardar lectura de oráculo
- [R12] GET /api/user/history - Historial de kins vistos
- [R13] GET /api/user/profile - Perfil extendido del usuario
- [R14] PUT /api/user/profile - Actualizar perfil
- [R15] DELETE /api/user/readings/{id} - Eliminar lectura guardada

---

## FASE 5: Validaciones y Form Requests

### Paso 5.1: Validaciones de Request
- [V01] GetKinRequest (validar kinId)
- [V02] GetDateKinRequest (validar formato de fecha)
- [V03] SaveKinRequest (validar datos de kin a guardar)
- [V04] SaveOracleRequest (validar lectura de oráculo)
- [V05] UpdateProfileRequest (validar perfil de usuario)

---

## FASE 6: Middleware Específicos

### Paso 6.1: Middleware de API
- [MID01] RateLimiter para endpoints públicos
- [MID02] CacheMiddleware para kins estáticos
- [MID03] RequestLogger middleware

---

## FASE 7: Documentación y Pruebas

### Paso 7.1: Documentación
- [D01] Documentar todos los endpoints API
- [D02] Crear ejemplos de uso
- [D03] Documentar códigos de error

### Paso 7.2: Testing
- [T01] Test de conversión de fechas
- [T02] Test de cálculo de Kin
- [T03] Test de cálculo de Oracle
- [T04] Test de endpoints API
- [T05] Test de autenticación con endpoints de Maya Calendar

---

## ESTRUCTURA DE RESPUESTA API

### Formato Kin
```json
{
  "id": 1,
  "solar_seal": "Dragon",
  "solar_seal_es": "Dragón",
  "galactic_tone": 1,
  "galactic_tone_name": "Magnetic",
  "color": "Red",
  "color_es": "Rojo",
  "kin_number": 1,
  "power": "Birth",
  "power_es": "Nacimiento",
  "action": "Nurtures",
  "action_es": "Nutre",
  "essence": "Being",
  "essence_es": "Ser",
  "description": "...",
  "is_gap": false,
  "is_core_day": false,
  "wavespell_id": 1,
  "castle_id": 1,
  "oracle": {
    "destiny": { "kin_id": 1, ... },
    "guide": { "kin_id": 14, ... },
    "analog": { "kin_id": 210, ... },
    "antipode": { "kin_id": 131, ... },
    "occult": { "kin_id": 210, ... }
  }
}
```

### Formato Wavespell
```json
{
  "id": 1,
  "number": 1,
  "solar_seal": "Dragon",
  "solar_seal_es": "Dragón",
  "color": "Red",
  "start_kin": 1,
  "end_kin": 13,
  "kin_count": 13,
  "description": "..."
}
```

### Formato Castle
```json
{
  "id": 1,
  "number": 1,
  "name": "Red Castle",
  "name_es": "Castillo Rojo",
  "color": "Red",
  "color_es": "Rojo",
  "start_kin": 1,
  "end_kin": 52,
  "kin_count": 52,
  "wavespell_count": 4,
  "description": "..."
}
```

---

## ORDEN DE EJECUCIÓN RECOMENDADO

1. FASE 1: Estructura de Base de Datos (M01-M16)
2. FASE 2: Servicios de Cálculo (S01-S10)
3. FASE 5: Validaciones (V01-V05)
4. FASE 3: Controladores (C01-C08)
5. FASE 4: Rutas API (R01-R15)
6. FASE 6: Middleware (MID01-MID03)
7. FASE 7: Documentación y Pruebas (D01-T05)

---

## TOTAL DE PASOS: 68 pasos organizados en 7 fases

Cada fase tiene dependencias claras y se puede ejecutar de manera secuencial. La API REST estará 100% funcional al completar todas las fases.