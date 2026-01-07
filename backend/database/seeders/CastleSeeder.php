<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Castle;

class CastleSeeder extends Seeder
{
    public function run(): void
    {
        Castle::create([
            'castle_number' => 1,
            'name' => 'Red Castle',
            'name_es' => 'Castillo Rojo',
            'color' => 'Red',
            'color_es' => 'Rojo',
            'start_kin' => 1,
            'end_kin' => 52,
            'kin_count' => 52,
            'wavespell_count' => 4,
            'description' => 'The Castle of Birthing. Court of Birth. The castle of turning matter.',
            'description_es' => 'El Castillo del Nacimiento. Corte del Nacimiento. El castillo de convertir la materia.',
        ]);

        Castle::create([
            'castle_number' => 2,
            'name' => 'White Castle',
            'name_es' => 'Castillo Blanco',
            'color' => 'White',
            'color_es' => 'Blanco',
            'start_kin' => 53,
            'end_kin' => 104,
            'kin_count' => 52,
            'wavespell_count' => 4,
            'description' => 'The Castle of Death. Court of Death. The castle of killing ego.',
            'description_es' => 'El Castillo de la Muerte. Corte de la Muerte. El castillo de matar el ego.',
        ]);

        Castle::create([
            'castle_number' => 3,
            'name' => 'Blue Castle',
            'name_es' => 'Castillo Azul',
            'color' => 'Blue',
            'color_es' => 'Azul',
            'start_kin' => 105,
            'end_kin' => 156,
            'kin_count' => 52,
            'wavespell_count' => 4,
            'description' => 'The Castle of Magic. Court of Magic. The castle of transforming time.',
            'description_es' => 'El Castillo de la Magia. Corte de la Magia. El castillo de transformar el tiempo.',
        ]);

        Castle::create([
            'castle_number' => 4,
            'name' => 'Yellow Castle',
            'name_es' => 'Castillo Amarillo',
            'color' => 'Yellow',
            'color_es' => 'Amarillo',
            'start_kin' => 157,
            'end_kin' => 208,
            'kin_count' => 52,
            'wavespell_count' => 4,
            'description' => 'The Castle of Intelligence. Court of Intelligence. The castle of maturing.',
            'description_es' => 'El Castillo de la Inteligencia. Corte de la Inteligencia. El castillo de madurar.',
        ]);

        Castle::create([
            'castle_number' => 5,
            'name' => 'Green Castle',
            'name_es' => 'Castillo Verde',
            'color' => 'Green',
            'color_es' => 'Verde',
            'start_kin' => 209,
            'end_kin' => 260,
            'kin_count' => 52,
            'wavespell_count' => 4,
            'description' => 'The Green Castle of Enchantment. Court of Maturation. The castle of flowering.',
            'description_es' => 'El Castillo Verde del Encantamiento. Corte de la Maduración. El castillo de florecer.',
        ]);
    }
}
