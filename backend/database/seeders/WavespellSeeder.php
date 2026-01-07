<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wavespell;

class WavespellSeeder extends Seeder
{
    public function run(): void
    {
        Wavespell::create([
            'wavespell_number' => 1,
            'solar_seal' => 'Dragon',
            'solar_seal_es' => 'Dragón',
            'color' => 'Red',
            'color_es' => 'Rojo',
            'start_kin' => 1,
            'end_kin' => 13,
            'kin_count' => 13,
            'description' => 'The Red Dragon Wavespell of Birth',
            'description_es' => 'La Onda Encantada del Dragón Rojo del Nacimiento',
        ]);

        Wavespell::create([
            'wavespell_number' => 2,
            'solar_seal' => 'Wind',
            'solar_seal_es' => 'Viento',
            'color' => 'White',
            'color_es' => 'Blanco',
            'start_kin' => 14,
            'end_kin' => 26,
            'kin_count' => 13,
            'description' => 'The White Wind Wavespell of Spirit',
            'description_es' => 'La Onda Encantada del Viento Blanco del Espíritu',
        ]);

        Wavespell::create([
            'wavespell_number' => 3,
            'solar_seal' => 'Night',
            'solar_seal_es' => 'Noche',
            'color' => 'Blue',
            'color_es' => 'Azul',
            'start_kin' => 27,
            'end_kin' => 39,
            'kin_count' => 13,
            'description' => 'The Blue Night Wavespell of Abundance',
            'description_es' => 'La Onda Encantada de la Noche Azul de la Abundancia',
        ]);

        Wavespell::create([
            'wavespell_number' => 4,
            'solar_seal' => 'Seed',
            'solar_seal_es' => 'Semilla',
            'color' => 'Yellow',
            'color_es' => 'Amarillo',
            'start_kin' => 40,
            'end_kin' => 52,
            'kin_count' => 13,
            'description' => 'The Yellow Seed Wavespell of Flowering',
            'description_es' => 'La Onda Encantada de la Semilla Amarilla del Florecimiento',
        ]);

        Wavespell::create([
            'wavespell_number' => 5,
            'solar_seal' => 'Serpent',
            'solar_seal_es' => 'Serpiente',
            'color' => 'Red',
            'color_es' => 'Rojo',
            'start_kin' => 53,
            'end_kin' => 65,
            'kin_count' => 13,
            'description' => 'The Red Serpent Wavespell of Life Force',
            'description_es' => 'La Onda Encantada de la Serpiente Roja de la Fuerza Vital',
        ]);

        Wavespell::create([
            'wavespell_number' => 6,
            'solar_seal' => 'World-Bridger',
            'solar_seal_es' => 'Puente del Mundo',
            'color' => 'White',
            'color_es' => 'Blanco',
            'start_kin' => 66,
            'end_kin' => 78,
            'kin_count' => 13,
            'description' => 'The White World-Bridger Wavespell of Death',
            'description_es' => 'La Onda Encantada del Puente del Mundo Blanco de la Muerte',
        ]);

        Wavespell::create([
            'wavespell_number' => 7,
            'solar_seal' => 'Hand',
            'solar_seal_es' => 'Mano',
            'color' => 'Blue',
            'color_es' => 'Azul',
            'start_kin' => 79,
            'end_kin' => 91,
            'kin_count' => 13,
            'description' => 'The Blue Hand Wavespell of Accomplishment',
            'description_es' => 'La Onda Encantada de la Mano Azul del Logro',
        ]);

        Wavespell::create([
            'wavespell_number' => 8,
            'solar_seal' => 'Star',
            'solar_seal_es' => 'Estrella',
            'color' => 'Yellow',
            'color_es' => 'Amarillo',
            'start_kin' => 92,
            'end_kin' => 104,
            'kin_count' => 13,
            'description' => 'The Yellow Star Wavespell of Elegance',
            'description_es' => 'La Onda Encantada de la Estrella Amarilla de la Elegancia',
        ]);

        Wavespell::create([
            'wavespell_number' => 9,
            'solar_seal' => 'Moon',
            'solar_seal_es' => 'Luna',
            'color' => 'Red',
            'color_es' => 'Rojo',
            'start_kin' => 105,
            'end_kin' => 117,
            'kin_count' => 13,
            'description' => 'The Red Moon Wavespell of Universal Water',
            'description_es' => 'La Onda Encantada de la Luna Roja del Agua Universal',
        ]);

        Wavespell::create([
            'wavespell_number' => 10,
            'solar_seal' => 'Dog',
            'solar_seal_es' => 'Perro',
            'color' => 'White',
            'color_es' => 'Blanco',
            'start_kin' => 118,
            'end_kin' => 130,
            'kin_count' => 13,
            'description' => 'The White Dog Wavespell of Heart',
            'description_es' => 'La Onda Encantada del Perro Blanco del Corazón',
        ]);

        Wavespell::create([
            'wavespell_number' => 11,
            'solar_seal' => 'Monkey',
            'solar_seal_es' => 'Mono',
            'color' => 'Blue',
            'color_es' => 'Azul',
            'start_kin' => 131,
            'end_kin' => 143,
            'kin_count' => 13,
            'description' => 'The Blue Monkey Wavespell of Magic',
            'description_es' => 'La Onda Encantada del Mono Azul de la Magia',
        ]);

        Wavespell::create([
            'wavespell_number' => 12,
            'solar_seal' => 'Human',
            'solar_seal_es' => 'Humano',
            'color' => 'Yellow',
            'color_es' => 'Amarillo',
            'start_kin' => 144,
            'end_kin' => 156,
            'kin_count' => 13,
            'description' => 'The Yellow Human Wavespell of Free Will',
            'description_es' => 'La Onda Encantada del Humano Amarillo del Libre Albedrío',
        ]);

        Wavespell::create([
            'wavespell_number' => 13,
            'solar_seal' => 'Skywalker',
            'solar_seal_es' => 'Caminante del Cielo',
            'color' => 'Red',
            'color_es' => 'Rojo',
            'start_kin' => 157,
            'end_kin' => 169,
            'kin_count' => 13,
            'description' => 'The Red Skywalker Wavespell of Space',
            'description_es' => 'La Onda Encantada del Caminante del Cielo Rojo del Espacio',
        ]);

        Wavespell::create([
            'wavespell_number' => 14,
            'solar_seal' => 'Wizard',
            'solar_seal_es' => 'Mago',
            'color' => 'White',
            'color_es' => 'Blanco',
            'start_kin' => 170,
            'end_kin' => 182,
            'kin_count' => 13,
            'description' => 'The White Wizard Wavespell of Timelessness',
            'description_es' => 'La Onda Encantada del Mago Blanco de la Atemporalidad',
        ]);

        Wavespell::create([
            'wavespell_number' => 15,
            'solar_seal' => 'Eagle',
            'solar_seal_es' => 'Águila',
            'color' => 'Blue',
            'color_es' => 'Azul',
            'start_kin' => 183,
            'end_kin' => 195,
            'kin_count' => 13,
            'description' => 'The Blue Eagle Wavespell of Vision',
            'description_es' => 'La Onda Encantada del Águila Azul de la Visión',
        ]);

        Wavespell::create([
            'wavespell_number' => 16,
            'solar_seal' => 'Warrior',
            'solar_seal_es' => 'Guerrero',
            'color' => 'Yellow',
            'color_es' => 'Amarillo',
            'start_kin' => 196,
            'end_kin' => 208,
            'kin_count' => 13,
            'description' => 'The Yellow Warrior Wavespell of Intelligence',
            'description_es' => 'La Onda Encantada del Guerrero Amarillo de la Inteligencia',
        ]);

        Wavespell::create([
            'wavespell_number' => 17,
            'solar_seal' => 'Earth',
            'solar_seal_es' => 'Tierra',
            'color' => 'Red',
            'color_es' => 'Rojo',
            'start_kin' => 209,
            'end_kin' => 221,
            'kin_count' => 13,
            'description' => 'The Red Earth Wavespell of Navigation',
            'description_es' => 'La Onda Encantada de la Tierra Roja de la Navegación',
        ]);

        Wavespell::create([
            'wavespell_number' => 18,
            'solar_seal' => 'Mirror',
            'solar_seal_es' => 'Espejo',
            'color' => 'White',
            'color_es' => 'Blanco',
            'start_kin' => 222,
            'end_kin' => 234,
            'kin_count' => 13,
            'description' => 'The White Mirror Wavespell of Endlessness',
            'description_es' => 'La Onda Encantada del Espejo Blanco del Infinito',
        ]);

        Wavespell::create([
            'wavespell_number' => 19,
            'solar_seal' => 'Storm',
            'solar_seal_es' => 'Tormenta',
            'color' => 'Blue',
            'color_es' => 'Azul',
            'start_kin' => 235,
            'end_kin' => 247,
            'kin_count' => 13,
            'description' => 'The Blue Storm Wavespell of Self-Generation',
            'description_es' => 'La Onda Encantada de la Tormenta Azul de la Autogeneración',
        ]);

        Wavespell::create([
            'wavespell_number' => 20,
            'solar_seal' => 'Sun',
            'solar_seal_es' => 'Sol',
            'color' => 'Yellow',
            'color_es' => 'Amarillo',
            'start_kin' => 248,
            'end_kin' => 260,
            'kin_count' => 13,
            'description' => 'The Yellow Sun Wavespell of Universal Fire',
            'description_es' => 'La Onda Encantada del Sol Amarillo del Fuego Universal',
        ]);
    }
}
