# Plan: Inicializar Frontend y Backend en Paralelo con Servidores en Background

## Estrategia

Los servidores de desarrollo (`npm run dev` y `php artisan serve`) corren indefinidamente y **bloquean el terminal**. Para evitar esto, los ejecutaré en background usando el modo `blocking: false`.

## Pasos a Ejecutar

### Fase 1: Crear Estructura de Carpetas

1. **Crear carpetas frontend/ y backend/**
2. **Verificar que están vacías o listas para crear proyectos**

### Fase 2: Inicializar Frontend (F01)

1. **Crear proyecto Vite con React en frontend/**

   * Usar `npm create vite@latest frontend -- --template react`

   * Este comando es rápido y no bloquea
2. **Instalar dependencias (F02)**

   * `cd frontend && npm install` (puede tardar, pero no bloquea)

   * React Router, Axios, Material UI M3, React Hook Form, date adapter

### Fase 3: Inicializar Backend (B01)

1. **Crear proyecto Laravel en backend/**

   * Usar Composer wrapper: `./composer create-project laravel/laravel backend`

   * Este comando es rápido y no bloquea
2. **Instalar dependencias (B02)**

   * Sanctum, Socialite, email service, Debugbar

   * Usar Composer wrapper para todos los comandos

### Fase 4: Configuración Inicial

1. **Frontend (F03-F06)**:

   * Estructura de carpetas

   * Tema Material UI M3

   * Configuración de routing

   * ESLint y Prettier

2. **Backend (B03-B05)**:

   * Configurar .env con conexión a MySQL (maya\_calendar)

   * Configurar base de datos (ya existe)

   * Configurar CORS para frontend

### Fase 5: Verificar Servidores (Sin Bloqueo)

1. **Iniciar frontend dev server en background**:

   * `cd frontend && npm run dev`

   * Usar `blocking: false` y `wait_ms_before_async: 3000`

   * Verificar que inicia en <http://localhost:5173>

2. **Iniciar backend server en background**:

   * `cd backend && /Applications/MAMP/bin/php/php8.2.0/bin/php artisan serve`

   * Usar `blocking: false` y `wait_ms_before_async: 3000`

   * Verificar que inicia en <http://localhost:8000>

### Fase 6: Verificación y Commits

1. **Verificar ambos servidores corren**

   * CheckCommandStatus para frontend (debe mostrar logs de Vite)

   * CheckCommandStatus para backend (debe mostrar "Server running on \[<http://127.0.0.1:8000>]")

2. **Commit: Initialize frontend and backend projects**

   * Incluir estructura inicial

   * Configuraciones básicas

## Importante: Servidores en Background

Los servidores se iniciarán con:

* **blocking: false** → No bloquean la ejecución

* **wait\_ms\_before\_async: 3000** → Esperan 3 segundos antes de liberar

* **Pueden monitorearse** → CheckCommandStatus muestra logs en tiempo real

* **Pueden detenerse** → StopCommand cuando sea necesario

## Notas para Usuario

* Los servidores **NO terminan nunca** hasta que uses `StopCommand`

* Son servidores de desarrollo para desarrollo en tiempo real

* Recargan automáticamente cuando haces cambios en el código

* No dejes que corran cuando no estés desarrollando (gastan recursos)

