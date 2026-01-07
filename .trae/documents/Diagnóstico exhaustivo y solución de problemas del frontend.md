## Plan de Diagnóstico y Solución de Problemas del Frontend

### 1. Cambio de puerto de VITE
- Cambiar puerto de VITE de 5173 a 5174 (o superior)
- Verificar configuración en vite.config.js

### 2. Checklist de Verificación Exhaustiva
Punto por punto para identificar errores:

**A. Verificación de Configuración**
- [ ] Revisar vite.config.js (puerto, host, proxy)
- [ ] Revisar package.json (scripts, dependencias)
- [ ] Verificar .env (variables de entorno)
- [ ] Comprobar main.jsx (renderizado de aplicación)

**B. Verificación de Estilos CSS**
- [ ] Revisar index.css (conflictos con Material UI)
- [ ] Verificar que los estilos M3 se estén aplicando
- [ ] Comprobar imports de CSS en main.jsx
- [ ] Revisar theme.js (configuración Material UI)

**C. Verificación de Componentes**
- [ ] Revisar AppLayout.jsx
- [ ] Verificar AuthContext.jsx se está importando en main.jsx
- [ ] Comprobar router.jsx (rutas y componentes)
- [ ] Verificar LoginPage, RegisterPage, ForgotPasswordPage
- [ ] Revisar que no haya errores de imports

**D. Verificación de Dependencias**
- [ ] Revisar package.json (todas las dependencias necesarias)
- [ ] Verificar que @mui/material, @mui/icons-material están instalados
- [ ] Comprobar react-router-dom está instalado
- [ ] Verificar axios está instalado

**E. Verificación de Consola y Errores**
- [ ] Iniciar servidor de desarrollo
- [ ] Abrir navegador y revisar consola
- [ ] Identificar errores de JavaScript
- [ ] Identificar warnings de React/MUI
- [ ] Verificar network tab (carga de recursos)

**F. Verificación de Estructura DOM**
- [ ] Inspeccionar elementos en DevTools
- [ ] Verificar que #root existe
- [ ] Comprobar que los componentes se renderizan
- [ ] Verificar estilos aplicados en elementos

**G. Verificación de Backend (si es necesario)**
- [ ] Verificar servidor backend está corriendo
- [ ] Comprobar endpoints de API
- [ ] Verificar CORS configuration

### 3. Ejecución del Checklist
- Ejecutar cada punto del checklist en orden
- Documentar cada error encontrado
- Aplicar solución correspondiente
- Verificar que la solución funciona

### 4. Confirmación Final
- Verificar que la pantalla no esté negra
- Confirmar que los componentes son visibles
- Probar navegación entre páginas
- Verificar que no haya errores en consola