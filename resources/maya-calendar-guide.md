# Guía de Referencia: Calendario Sincronizador Maya

## Tabla de Contenidos

1. [Introducción](#introducción)
2. [Conceptos Fundamentales](#conceptos-fundamentales)
3. [Mecánica de Funcionamiento](#mecánica-de-funcionamiento)
4. [Cálculos Principales](#cálculos-principales)
5. [El Oráculo de los 5 Peldaños](#el-oráculo-de-los-5-peldaños)
6. [La Onda Encantada](#la-onda-encantada)
7. [Los Castillos](#los-castillos)
8. [Días Especiales](#días-especiales)
9. [Ejemplos Prácticos](#ejemplos-prácticos)
10. [Recursos y Referencias](#recursos-y-referencias)

---

## Introducción

### ¿Qué es el Calendario Sincronizador Maya?

El Calendario Sincronizador Maya, también conocido como **Dreamspell**, es una reinterpretación moderna del antiguo calendario maya Tzolkin. Combina:

- El ciclo sagrado de 260 días (Tzolkin)
- Los 20 Sellos Solares (arquetipos de energía)
- Los 13 Tonos Galácticos (frecuencias de acción)
- El concepto de tiempo cíclico vs. tiempo lineal

### Diferencia con el Calendario Gregoriano

| Aspecto | Calendario Gregoriano | Calendario Maya |
|---------|---------------------|------------------|
| **Naturaleza del tiempo** | Lineal (pasado → futuro) | Cíclico (espiral) |
| **Ciclo base** | 365 días (año) | 260 días (Tzolkin) |
| **Unidad** | Día sin significado | Kin (día con energía específica) |
| **Propósito** | Medición física | Sincronización consciente |

### Concepto de Tiempo Sagrado

El calendario maya considera el tiempo como:

- **Cíclico**: Los patrones se repiten en espiral
- **Consciente**: Cada momento tiene una cualidad única
- **Sincrónico**: Todo está interconectado
- **Medible**: Se puede calcular y predecir

---

## Conceptos Fundamentales

### Kin: La Unidad Básica

**Kin** = Día + Energía

Cada día en el calendario maya tiene:
- Un número de Kin (1-260)
- Un Tono Galáctico (1-13)
- Un Sello Solar (1-20)
- Una cualidad energética única

```
Ejemplo: Kin 1 = Dragón Rojo Magnético
- Número: 1
- Tono: 1 (Magnético)
- Sello: 1 (Dragón)
- Color: Rojo
```

### Tono Galáctico: Energía de Acción

Los **13 Tonos Galácticos** representan la frecuencia de acción o la cualidad de manifestación. Cada Kin tiene un tono del 1 al 13.

Los tonos forman una onda de 13 pasos que describe un proceso creativo completo.

### Sello Solar: Arquetipo de Energía

Los **20 Sellos Solares** representan arquetipos de energía o cualidades primordiales. Cada Kin tiene un sello del 1 al 20.

Los sellos se organizan en 4 colores:
- Rojo (inicia, dirección este)
- Blanco (refina, dirección norte)
- Azul (transforma, dirección oeste)
- Amarillo (madura, dirección sur)

### Oráculo: 5 Energías Relacionadas

Cada Kin tiene un **Oráculo de 5 Peldaños** que muestra las energías que lo rodean:

```
        [Guía]
        [Tono]
    [Antípoda] [Destino] [Análogo]
        [Tono]  [Tono]  [Tono]
        [Oculto]
        [Tono]
```

### Onda Encantada: Ciclo de 13 Días

Una **Onda Encantada** es un ciclo de 13 días que representa un proceso creativo completo. Cada Onda está gobernada por un Sello Solar.

### Castillo: Ciclo de 52 Días

Un **Castillo** es un ciclo de 52 días (4 Ondas) que representa una fase mayor de evolución. Hay 5 Castillos que suman 260 días.

---

## Mecánica de Funcionamiento

### El Ciclo Tzolkin de 260 Días

El **Tzolkin** es el ciclo sagrado de 260 días que se repite continuamente. Se calcula como:

```
260 = 13 Tonos × 20 Sellos
```

**Características**:
- Cada combinación Tono+Sello es única
- El ciclo es infinito
- El patrón de colores se repite cada 5 días
- El patrón de tonos se repite cada 13 días
- El patrón de sellos se repite cada 20 días

### Cómo se Calcula un Kin desde Fecha Gregoriana

**Fecha de Referencia**:
- 26 de julio de 1987 = Kin 1 (Dragón Rojo Magnético)
- Esta fecha marca el inicio del ciclo actual del Dreamspell

**Algoritmo Básico**:

1. Calcular días totales desde 26 de julio de 1987
2. Restar días bisiestos (29 de febrero NO cuenta)
3. Aplicar módulo 260
4. Agregar 1 (porque Kin va de 1 a 260)

**Ejemplo**:
```
Fecha: 26 de julio de 2025
Días desde 1987-07-26: 13,880 días
Años bisiestos en ese periodo: 9 días
Días netos: 13,880 - 9 = 13,871
Kin = (13,871 % 260) + 1 = 132
```

### Manejo de Años Bisiestos

**Regla Crítica**: El 29 de febrero es el "Día Fuera del Tiempo" y **NO se cuenta** en el cálculo.

```
Ejemplo: 29 de febrero de 2024
- Se salta este día en el cálculo
- 1 de marzo de 2024 continúa el cálculo normal
```

**Impacto en el cálculo**:
```
Para calcular años bisiestos entre fecha A y fecha B:
- Identificar todos los años divisibles por 4
- Verificar si no son divisibles por 100 (o sí por 400)
- Restar cada 29 de febrero encontrado
```

### Flujo de Cálculo

```
Fecha Gregoriana
        ↓
Calcular días desde 26/07/1987
        ↓
Identificar y restar días bisiestos
        ↓
Aplicar módulo 260
        ↓
Agregar 1 (Kin va de 1-260)
        ↓
Número de Kin (1-260)
        ↓
Calcular Tono: (Kin - 1) % 13 + 1
        ↓
Calcular Sello: (Kin - 1) % 20 + 1
        ↓
Determinar Color según Sello
        ↓
Calcular Oráculo completo
```

---

## Cálculos Principales

### Cálculo del Número de Kin (1-260)

**Fórmula**:
```
kin_number = (total_days % 260) + 1
```

**Donde**:
```
total_days = días desde 26/07/1987 - días bisiestos
```

**Algoritmo Python**:
```python
def calculate_kin_number(date):
    reference_date = datetime(1987, 7, 26)
    total_days = (date - reference_date).days
    leap_days = count_leap_days(reference_date, date)
    total_days -= leap_days
    while total_days < 0:
        total_days += 260
    kin_number = (total_days % 260) + 1
    return kin_number
```

### Determinación del Tono (1-13)

**Fórmula**:
```
tone = ((kin_number - 1) % 13) + 1
```

**Ejemplos**:
```
Kin 1   → Tono 1
Kin 13  → Tono 13
Kin 14  → Tono 1
Kin 260 → Tono 13
```

### Determinación del Sello (1-20)

**Fórmula**:
```
seal = ((kin_number - 1) % 20) + 1
```

**Ejemplos**:
```
Kin 1   → Sello 1 (Dragón)
Kin 20  → Sello 20 (Sol)
Kin 21  → Sello 1 (Dragón)
Kin 260 → Sello 20 (Sol)
```

### Determinación del Color

Cada Sello tiene un color fijo:

**Rojo** (1, 5, 9, 13, 17):
- 1: Dragón
- 5: Serpiente
- 9: Luna Roja
- 13: Caminante del Cielo
- 17: Tierra Roja

**Blanco** (2, 6, 10, 14, 18):
- 2: Viento
- 6: Enlazador de Mundos
- 10: Perro
- 14: Mago
- 18: Espejo

**Azul** (3, 7, 11, 15, 19):
- 3: Noche
- 7: Mano
- 11: Mono
- 15: Águila
- 19: Tormenta

**Amarillo** (4, 8, 12, 16, 20):
- 4: Semilla
- 8: Estrella
- 12: Humano
- 16: Guerrero
- 20: Sol

---

## El Oráculo de los 5 Peldaños

### Estructura del Oráculo

```
        [Guía]
        Tono X
    Antípoda  [Destino]  Análogo
     Tono Y     Tono Z    Tono W
        [Oculto]
        Tono V
```

### Destino (Centro): Tu Energía Principal

**Descripción**: Propósito de vida, identidad esencial, tu energía principal

**Cálculo**:
```
destino_tone = ((kin_number - 1) % 13) + 1
destiny_seal = ((kin_number - 1) % 20) + 1
destiny_color = get_color(destiny_seal)
```

**Interpretación**: Representa tu energía central, tu propósito fundamental en esta vida.

### Guía (Arriba): Tu Energía de Orientación

**Descripción**: Tu energía superior, guía espiritual, lo que te orienta

**Cálculo**:
```
guide_tone = ((tone + 12) % 13) + 1
guide_seal = seal
guide_color = color

EXCEPCIÓN: Para Tonos 1, 6, 11:
    guide_tone = tone
```

**Interpretación**: Es la energía que te guía desde arriba, tu conexión con el propósito superior.

### Análogo (Derecha): Energía de Apoyo

**Descripción**: Cualidad similar, energía de apoyo, lo que te refuerza

**Cálculo**:
```
analog_tone = tone
analog_seal = (seal + 7) % 20 + 1
analog_color = get_color(analog_seal)
```

**Interpretación**: Es la energía que te apoya, similar a tu energía principal pero más suave.

### Antípoda (Izquierda): Energía de Desafío

**Descripción**: Desafío, lección de vida, lo que te fortalece a través de la oposición

**Cálculo**:
```
antipode_tone = tone
antipode_seal = (seal + 10) % 20 + 1
antipode_color = get_color(antipode_seal)
```

**Interpretación**: Es tu desafío, la energía opuesta que te ayuda a crecer.

### Oculto (Abajo): Tu Energía Oculta

**Descripción**: Energía oculta, don subconsciente, tu talento latente

**Cálculo**:
```
occult_tone = 14 - tone
occult_seal = (seal + 12) % 20 + 1
occult_color = get_color(occult_seal)
```

**Interpretación**: Es tu energía oculta, un talento o don que se activa cuando menos lo esperas.

### Ejemplo de Oráculo Completo

**Kin 1: Dragón Rojo Magnético**

```
        [Viento Blanco]
        Tono 13
    [Noche Azul]  [Dragón Rojo]  [Serpiente Roja]
     Tono 1         Tono 1         Tono 1
        [Tormenta Azul]
        Tono 13
```

- **Destino**: Dragón Rojo Magnético
- **Guía**: Viento Blanco Cósmico
- **Análogo**: Serpiente Roja Magnética
- **Antípoda**: Noche Azul Magnética
- **Oculto**: Tormenta Azul Cósmica

---

## La Onda Encantada

### ¿Qué es y Por Qué 13 Días?

Una **Onda Encantada** es un ciclo de 13 días que representa un proceso creativo completo. Los 13 días corresponden a los 13 Tonos Galácticos.

**Por qué 13 días**:
- 13 es un número sagrado en muchas tradiciones
- Representa un ciclo completo de manifestación
- Cada día de la Onda tiene un significado específico
- La Onda describe el proceso de creación de un propósito

### Significado de Cada Posición (1-13)

**Posición 1: Magnético (Propósito)**
- Inicio del ciclo
- Definición del propósito
- Atracción de recursos

**Posición 2: Lunar (Desafío)**
- Identificación del desafío
- Polaridad y contraste
- Estabilización del propósito

**Posición 3: Eléctrico (Servicio)**
- Activación del servicio
- Conexión eléctrica
- Movimiento hacia la acción

**Posición 4: Autoexistente (Forma)**
- Definición de la forma
- Estructura y medida
- Solidificación del propósito

**Posición 5: En-tonado (Empoderamiento)**
- Comando del poder
- Recolección de recursos
- Empoderamiento personal

**Posición 6: Rítmico (Organización)**
- Organización del flujo
- Equilibrio y ritmo
- Sincronización

**Posición 7: Resonante (Canalización)**
- Canalización de energía
- Resonancia con el propósito
- Conexión profunda

**Posición 8: Galáctico (Integridad)**
- Integración armónica
- Modelado del propósito
- Armonización

**Posición 9: Solar (Intención)**
- Intención y pulsación
- Realización del propósito
- Acción deliberada

**Posición 10: Planetario (Manifestación)**
- Manifestación perfecta
- Producción de resultados
- Materialización

**Posición 11: Espectral (Liberación)**
- Liberación y disolución
- Soltar lo que no sirve
- Preparación para la finalización

**Posición 12: Cristal (Cooperación)**
- Cooperación universal
- Dedicación del propósito
- Conexión con todos

**Posición 13: Cósmico (Trascendencia)**
- Trascendencia y presencia
- Finalización del ciclo
- Preparación para el nuevo inicio

### Cómo Determinar la Onda de una Fecha

**Fórmula**:
```
start_kin = ((kin_number - 1) // 13) * 13 + 1
end_kin = start_kin + 12
wavespell_seal = ((start_kin - 1) % 20) + 1
wavespell_color = get_color(wavespell_seal)
position = ((kin_number - 1) % 13) + 1
```

**Ejemplo**:
```
Fecha: 26 de julio de 2025
Kin: 132

start_kin = ((132 - 1) // 13) * 13 + 1 = 121
end_kin = 121 + 12 = 133
wavespell_seal = ((121 - 1) % 20) + 1 = 1 (Dragón)
wavespell_color = Rojo
position = ((132 - 1) % 13) + 1 = 12 (Cristal)

Resultado: Kin 132 está en posición 12 (Cristal) de la Onda del Dragón Rojo
```

### Onda de Nacimiento vs. Onda Actual

**Onda de Nacimiento**:
- Determinada por tu fecha de nacimiento
- Representa tu energía fundamental
- Es la Onda que gobierna tu vida

**Onda Actual**:
- Determinada por la fecha de hoy
- Representa la energía del momento
- Cambia cada 13 días

**Relación**:
- Tu Onda de nacimiento está activa en el ciclo anual
- Cada año, tienes una "Onda de nacimiento" que comienza en tu cumpleaños
- Comprender tu Onda de nacimiento ayuda a entender tu propósito
- Comprender la Onda actual ayuda a navegar el momento presente

---

## Los Castillos

### 5 Castillos de 52 Días

Un **Castillo** es un ciclo de 52 días (4 Ondas de 13 días cada una) que representa una fase mayor de evolución.

**Duración**:
```
1 Castillo = 4 Ondas = 52 días
5 Castillos = 20 Ondas = 260 días (1 ciclo Tzolkin)
```

### Significado de Cada Castillo

**Castillo Rojo del Este: Giro del Nacimiento**
- Castillos: 1
- Duración: Kin 1 - 52
- Propósito: Nacimiento, iniciación, plantar semillas
- Calidad: Fuego, iniciación, dirección

**Castillo Blanco del Norte: Giro de la Muerte**
- Castillos: 2
- Duración: Kin 53 - 104
- Propósito: Muerte del viejo yo, transformación, refinamiento
- Calidad: Aire, purificación, dirección

**Castillo Azul del Oeste: Giro de la Magia**
- Castillos: 3
- Duración: Kin 105 - 156
- Propósito: Magia, transformación profunda, alquimia
- Calidad: Agua, transformación, dirección

**Castillo Amarillo del Sur: Giro de la Inteligencia**
- Castillos: 4
- Duración: Kin 157 - 208
- Propósito: Inteligencia, madurez, cosecha
- Calidad: Tierra, maduración, dirección

**Castillo Verde del Centro: Giro de la Matriz**
- Castillos: 5
- Duración: Kin 209 - 260
- Propósito: Trascendencia, síntesis, nuevo inicio
- Calidad: Éter, síntesis, centro

### Cómo Determinar el Castillo Actual

**Fórmula**:
```
castle = ((kin_number - 1) // 52) + 1
castle_kin = ((castle - 1) * 52) + 1
```

**Ejemplo**:
```
Kin 132

castle = ((132 - 1) // 52) + 1 = 3 (Castillo Azul)
castle_kin = ((3 - 1) * 52) + 1 = 105

Resultado: Kin 132 está en el Castillo Azul del Oeste (Giro de la Magia)
```

### Duración: 260 Días (1 Ciclo Completo)

El ciclo completo de 5 Castillos dura exactamente 260 días, que es un ciclo Tzolkin completo.

```
Castillo 1 (Rojo): Kin 1-52
Castillo 2 (Blanco): Kin 53-104
Castillo 3 (Azul): Kin 105-156
Castillo 4 (Amarillo): Kin 157-208
Castillo 5 (Verde): Kin 209-260
```

---

## Días Especiales

### Días GAP (Galactic Activation Portals)

**Descripción**: Los Días GAP son "Puertos de Activación Galáctica" - días de intensa energía donde los portales interdimensionales están abiertos.

**Características**:
- 52 días GAP en cada ciclo de 260 días
- Patrón específico de ocurrencia
- Energía intensificada y propicia para cambios
- Momentos de activación y transformación

**Cómo Identificarlos**:

Los días GAP ocurren en posiciones específicas del ciclo de 52 días:

```
Patrón GAP en ciclo de 52 días:
4, 5, 6, 7, 11, 12, 18, 19, 25, 26, 27, 28, 32, 33, 39, 40, 46, 47, 48, 49, 50, 51
```

**Algoritmo**:
```python
def is_gap_day(kin_number):
    position_in_52_cycle = (kin_number - 1) % 52 + 1
    gap_positions = [4, 5, 6, 7, 11, 12, 18, 19, 25, 26, 27, 28, 32, 33, 39, 40, 46, 47, 48, 49, 50, 51]
    return position_in_52_cycle in gap_positions
```

**Ejemplos**:
```
Kin 4 → GAP
Kin 7 → GAP
Kin 13 → NO GAP
Kin 52 → GAP
Kin 53 → NO GAP
```

### Días Núcleo (Columna Mística)

**Descripción**: Los Días Núcleo son días de alineación central, donde la energía está especialmente equilibrada y centrada.

**Características**:
- Cada 13° Kin (7, 20, 33, 46, 59, ...)
- 20 días Núcleo en cada ciclo de 260 días
- Energía de centro, equilibrio y síntesis
- Momentos de integración profunda

**Cómo Identificarlos**:

```
Patrón Núcleo:
Kin 7, 20, 33, 46, 59, 72, 85, 98, 111, 124, 137, 150, 163, 176, 189, 202, 215, 228, 241, 254
```

**Algoritmo**:
```python
def is_core_day(kin_number):
    core_kins = [7, 20, 33, 46, 59, 72, 85, 98, 111, 124, 137, 150, 163, 176, 189, 202, 215, 228, 241, 254]
    return kin_number in core_kins
```

**Ejemplos**:
```
Kin 7 → Núcleo
Kin 13 → NO Núcleo
Kin 20 → Núcleo
Kin 254 → Núcleo
Kin 260 → NO Núcleo
```

### Día Fuera del Tiempo (29 de Febrero)

**Descripción**: El 29 de febrero es el "Día Fuera del Tiempo" - un día que no se cuenta en el calendario maya.

**Características**:
- No se cuenta en el cálculo del Kin
- Es un día sagrado de pausa y reflexión
- Momento de salir del tiempo lineal
- Se salta en todos los cálculos

**Manejo en Cálculos**:

```python
def count_leap_days(start_date, end_date):
    count = 0
    for year in range(start_date.year, end_date.year + 1):
        if (year % 4 == 0 and year % 100 != 0) or (year % 400 == 0):
            count += 1
    return count
```

**Ejemplo**:
```
28 de febrero de 2024 → Kin X
29 de febrero de 2024 → Día Fuera del Tiempo (no cuenta)
1 de marzo de 2024 → Kin X+1 (continúa normal)
```

### Significado y Cómo Identificarlos

**Resumen de Identificación**:

| Tipo de Día | Cantidad en 260 días | Patrón | Cómo Identificar |
|-------------|---------------------|---------|------------------|
| GAP | 52 | Posiciones específicas en ciclo de 52 | `(kin-1)%52+1` en `[4,5,6,7,11,12,18,19,25,26,27,28,32,33,39,40,46,47,48,49,50,51]` |
| Núcleo | 20 | Cada 13° Kin | Kin en `[7,20,33,46,59,72,85,98,111,124,137,150,163,176,189,202,215,228,241,254]` |
| Fuera del Tiempo | 1 (año bisiesto) | 29 de febrero | No se cuenta en cálculo |

---

## Ejemplos Prácticos

### Ejercicio 1: Calcular Kin de Hoy

**Paso 1**: Obtener fecha actual
```
Fecha: 7 de enero de 2026
```

**Paso 2**: Calcular días desde 26 de julio de 1987
```
Años: 2026 - 1987 = 39 años
Días totales: 39 × 365 = 14,235 días
Días adicionales: (enero 1-7) + (julio 26-31) = 7 + 6 = 13 días
Total: 14,235 + 13 = 14,248 días
```

**Paso 3**: Restar días bisiestos
```
Años bisiestos (1988-2024): 10 años
Días bisiestos: 10 días
Días netos: 14,248 - 10 = 14,238 días
```

**Paso 4**: Calcular Kin
```
Kin = (14,238 % 260) + 1
14,238 ÷ 260 = 54 remanente 198
Kin = 198 + 1 = 199
```

**Paso 5**: Calcular Tono y Sello
```
Tono = ((199 - 1) % 13) + 1 = (198 % 13) + 1 = 3 + 1 = 4
Sello = ((199 - 1) % 20) + 1 = (198 % 20) + 1 = 18 + 1 = 19
```

**Resultado**:
```
7 de enero de 2026 = Kin 199 = Tormenta Azul Autoexistente
```

### Ejercicio 2: Interpretar Tu Propio Oráculo

**Ejemplo**: Fecha de nacimiento: 15 de mayo de 1990

**Paso 1**: Calcular Kin
```
Días desde 26/07/1987: 1,024 días
Días bisiestos: 1 (1988)
Días netos: 1,023
Kin = (1,023 % 260) + 1 = 244
```

**Paso 2**: Calcular Tono y Sello
```
Tono = ((244 - 1) % 13) + 1 = 8 (Galáctico)
Sello = ((244 - 1) % 20) + 1 = 4 (Semilla)
Color = Amarillo
```

**Paso 3**: Calcular Oráculo Completo

**Destino**: Semilla Amarilla Galáctica

**Guía**:
```
guide_tone = ((8 + 12) % 13) + 1 = 7 (Resonante)
guide_seal = 4 (Semilla)
guide_color = Amarillo
```
→ Semilla Amarilla Resonante

**Análogo**:
```
analog_seal = (4 + 7) % 20 + 1 = 11 (Mono)
analog_color = Azul
```
→ Mono Azul Galáctico

**Antípoda**:
```
antipode_seal = (4 + 10) % 20 + 1 = 14 (Mago)
antipode_color = Blanco
```
→ Mago Blanco Galáctico

**Oculto**:
```
occult_tone = 14 - 8 = 6 (Rítmico)
occult_seal = (4 + 12) % 20 + 1 = 16 (Guerrero)
occult_color = Amarillo
```
→ Guerrero Amarillo Rítmico

**Oráculo Completo**:
```
        [Semilla Amarilla Resonante]
    [Mago Blanco]  [Semilla Amarilla]  [Mono Azul]
       Galáctico        Galáctico        Galáctico
        [Guerrero Amarillo]
            Rítmico
```

**Interpretación**:
- **Propósito**: Florecer como semilla de luz (Semilla Amarilla Galáctica)
- **Guía**: Guiado por tu propia semilla de florecimiento (Semilla Resonante)
- **Apoyo**: Juego, magia y creatividad (Mono Galáctico)
- **Desafío**: Magia blanca, adivinación, tiempo atemporal (Mago Galáctico)
- **Oculto**: Inteligencia, cuestionamiento, poder de la mente (Guerrero Rítmico)

### Ejercicio 3: Encontrar Tu Onda de Nacimiento

**Usando el ejemplo anterior**: Kin 244 (Semilla Amarilla Galáctica)

**Paso 1**: Calcular inicio de Onda
```
start_kin = ((244 - 1) // 13) * 13 + 1 = 235
```

**Paso 2**: Calcular fin de Onda
```
end_kin = 235 + 12 = 247
```

**Paso 3**: Determinar Sello que gobierna la Onda
```
wavespell_seal = ((235 - 1) % 20) + 1 = 15 (Águila)
wavespell_color = Azul
```

**Paso 4**: Determinar posición en la Onda
```
position = ((244 - 1) % 13) + 1 = 10 (Planetario)
```

**Resultado**:
```
Nacido en posición 10 (Planetario) de la Onda del Águila Azul
```

**Interpretación de la Onda del Águila**:
- **Propósito**: Visión planetaria, ver el panorama completo
- **Tu posición (10)**: Manifestación perfecta de la visión
- **Don**: Capacidad de ver más allá, perspectiva elevada

### Ejercicios Paso a Paso

**Ejercicio 4: Calcular Kin de cualquier fecha**

1. **Escribe la fecha**: ___/___/_____
2. **Calcula días desde 26/07/1987**: _____ días
3. **Cuenta años bisiestos en ese periodo**: _____ años
4. **Resta días bisiestos**: _____ - _____ = _____ días netos
5. **Aplica módulo 260**: _____ % 260 = _____
6. **Agrega 1**: _____ + 1 = Kin _____
7. **Calcula Tono**: (_____ - 1) % 13 + 1 = Tono _____
8. **Calcula Sello**: (_____ - 1) % 20 + 1 = Sello _____
9. **Determina Color**: _____
10. **Nombre completo**: _____ _____ _____

---

## Recursos y Referencias

### Tabla de Tonos (1-13)

| # | Tono | Acción | Poder | Esencia | Función |
|---|------|--------|-------|---------|---------|
| 1 | Magnético | Unificar | Propósito | Atracción | Iniciar |
| 2 | Lunar | Polarizar | Desafío | Estabilizar | Definir |
| 3 | Eléctrico | Activar | Servicio | Vincular | Conectar |
| 4 | Autoexistente | Definir | Forma | Medir | Identificar |
| 5 | En-tonado | Comandar | Empoderamiento | Conferir | Recibir |
| 6 | Rítmico | Organizar | Igualdad | Equilibrar | Sincronizar |
| 7 | Resonante | Canalizar | Armonía | Inspirar | Alinear |
| 8 | Galáctico | Armonizar | Integridad | Modelar | Vivir |
| 9 | Solar | Pulsar | Intención | Realizar | Intencionar |
| 10 | Planetario | Perfeccionar | Manifestación | Producir | Perfeccionar |
| 11 | Espectral | Disolver | Liberación | Soltar | Liberar |
| 12 | Cristal | Dedicar | Cooperación | Universalizar | Dedicar |
| 13 | Cósmico | Trascender | Presencia | Trascender | Endurecer |

### Tabla de Sellos (1-20)

| # | Sello | Color | Arquetipo | Dirección | Elemento |
|---|-------|-------|-----------|------------|----------|
| 1 | Dragón | Rojo | Nacimiento | Este | Tierra |
| 2 | Viento | Blanco | Espíritu | Norte | Aire |
| 3 | Noche | Azul | Sueño | Oeste | Agua |
| 4 | Semilla | Amarillo | Florecimiento | Sur | Fuego |
| 5 | Serpiente | Rojo | Instinto | Este | Tierra |
| 6 | Enlazador de Mundos | Blanco | Muerte | Norte | Aire |
| 7 | Mano | Azul | Conocimiento | Oeste | Agua |
| 8 | Estrella | Amarillo | Arte | Sur | Fuego |
| 9 | Luna Roja | Rojo | Agua | Este | Tierra |
| 10 | Perro | Blanco | Corazón | Norte | Aire |
| 11 | Mono | Azul | Magia | Oeste | Agua |
| 12 | Humano | Amarillo | Sabiduría | Sur | Fuego |
| 13 | Caminante del Cielo | Rojo | Espacio | Este | Tierra |
| 14 | Mago | Blanco | Tiempo | Norte | Aire |
| 15 | Águila | Azul | Visión | Oeste | Agua |
| 16 | Guerrero | Amarillo | Inteligencia | Sur | Fuego |
| 17 | Tierra Roja | Rojo | Navegación | Este | Tierra |
| 18 | Espejo | Blanco | Infinito | Norte | Aire |
| 19 | Tormenta | Azul | Autogeneración | Oeste | Agua |
| 20 | Sol | Amarillo | Iluminación | Sur | Fuego |

### Colores y Su Significado

**Rojo (Este - Inicia)**:
- Inicia, da dirección
- Elemento: Tierra/Fuego
- Cualidad: Iniciación, comienzo
- Acción: Sembrar, iniciar

**Blanco (Norte - Refina)**:
- Refina, purifica
- Elemento: Aire
- Cualidad: Limpieza, claridad
- Acción: Purificar, aclarar

**Azul (Oeste - Transforma)**:
- Transforma, cambia
- Elemento: Agua
- Cualidad: Transformación, cambio
- Acción: Transformar, cambiar

**Amarillo (Sur - Madura)**:
- Madura, cosecha
- Elemento: Fuego
- Cualidad: Maduración, cosecha
- Acción: Cosechar, madurar

### Relaciones Entre Sellos

**Familias de Sellos** (4 sellos por familia):

**Familia del Dragón (Columna 1)**:
1. Dragón (Rojo) - Nacimiento
2. Viento (Blanco) - Espíritu
3. Noche (Azul) - Sueño
4. Semilla (Amarillo) - Florecimiento

**Familia de la Serpiente (Columna 6)**:
5. Serpiente (Rojo) - Instinto
6. Enlazador (Blanco) - Muerte
7. Mano (Azul) - Conocimiento
8. Estrella (Amarillo) - Arte

**Familia de la Luna Roja (Columna 11)**:
9. Luna Roja (Rojo) - Agua
10. Perro (Blanco) - Corazón
11. Mono (Azul) - Magia
12. Humano (Amarillo) - Sabiduría

**Familia del Caminante del Cielo (Columna 16)**:
13. Caminante (Rojo) - Espacio
14. Mago (Blanco) - Tiempo
15. Águila (Azul) - Visión
16. Guerrero (Amarillo) - Inteligencia

**Familia de la Tierra Roja (Columna 17)**:
17. Tierra Roja (Rojo) - Navegación
18. Espejo (Blanco) - Infinito
19. Tormenta (Azul) - Autogeneración
20. Sol (Amarillo) - Iluminación

### Referencias Bibliográficas

**Fuentes Principales**:
- The Law of Time - José Argüelles
- Dreamspell: The Journey of Timeship Earth - José Argüelles
- The Mayan Factor - José Argüelles
- 13 Moon Calendar - Various Authors

**Recursos Online**:
- lawoftime.org
- mayankin.com
- 13moon.com

**Software y Herramientas**:
- Mayan Kin Calculator (online)
- Dreamspell Apps (iOS/Android)
- Mayan Calendar Software

---

## Apéndice: Glosario de Términos

- **Kin**: Día energético del calendario maya
- **Tono**: Frecuencia de acción (1-13)
- **Sello**: Arquetipo de energía (1-20)
- **Oráculo**: Conjunto de 5 energías relacionadas
- **Onda Encantada**: Ciclo de 13 días
- **Castillo**: Ciclo de 52 días
- **Tzolkin**: Ciclo sagrado de 260 días
- **GAP**: Galactic Activation Portal (Puerto de Activación Galáctica)
- **Día Núcleo**: Día de alineación central
- **Día Fuera del Tiempo**: 29 de febrero, día que no se cuenta

---

## Notas Finales

Esta guía proporciona la mecánica fundamental del Calendario Sincronizador Maya. Para una comprensión más profunda, se recomienda:

1. **Práctica Diaria**: Calcular el Kin de cada día
2. **Estudio Personal**: Conocer tu propio Kin y Oráculo
3. **Observación**: Notar cómo las energías se manifiestan en tu vida
4. **Comunidad**: Conectar con otros practicantes del calendario maya
5. **Profundización**: Estudiar las fuentes originales y libros especializados

El calendario maya es una herramienta poderosa para la sincronización consciente con los ciclos naturales del tiempo. ¡Que disfrutes tu viaje a través del Tzolkin!

---

**Versión**: 1.0
**Fecha**: 7 de enero de 2026
**Autoría**: Basado en las enseñanzas del Dreamspell de José Argüelles
