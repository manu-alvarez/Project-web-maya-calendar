<?php

namespace Database\Factories;

use App\Models\Kin;
use Illuminate\Database\Eloquent\Factories\Factory;

class KinFactory extends Factory
{
    protected $model = Kin::class;

    public function definition(): array
    {
        return [
            'kin_number' => $this->faker->numberBetween(1, 260),
            'solar_seal' => $this->faker->randomElement(['Dragon', 'Wind', 'Night', 'Seed', 'Serpent', 'World-Bridger', 'Hand', 'Star', 'Moon', 'Dog', 'Monkey', 'Human', 'Skywalker', 'Wizard', 'Eagle', 'Warrior', 'Earth', 'Mirror', 'Storm', 'Sun']),
            'solar_seal_es' => $this->faker->randomElement(['Dragón', 'Viento', 'Noche', 'Semilla', 'Serpiente', 'Puente Mundo', 'Mano', 'Estrella', 'Luna', 'Perro', 'Mono', 'Humano', 'Caminante del Cielo', 'Mago', 'Águila', 'Guerrero', 'Tierra', 'Espejo', 'Tormenta', 'Sol']),
            'galactic_tone' => $this->faker->numberBetween(1, 13),
            'galactic_tone_name' => $this->faker->randomElement(['Magnetic', 'Lunar', 'Electric', 'Self-Existing', 'Overtone', 'Rhythmic', 'Resonant', 'Galactic', 'Solar', 'Planetary', 'Spectral', 'Crystal', 'Cosmic']),
            'color' => $this->faker->randomElement(['Red', 'White', 'Blue', 'Yellow']),
            'color_es' => $this->faker->randomElement(['Rojo', 'Blanco', 'Azul', 'Amarillo']),
            'power' => $this->faker->word(),
            'power_es' => $this->faker->word(),
            'action' => $this->faker->word(),
            'action_es' => $this->faker->word(),
            'essence' => $this->faker->word(),
            'essence_es' => $this->faker->word(),
            'is_gap' => $this->faker->boolean(),
            'is_core_day' => $this->faker->boolean(),
            'wavespell_id' => $this->faker->numberBetween(1, 20),
            'castle_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
