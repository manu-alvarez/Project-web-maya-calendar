<?php

namespace Database\Factories;

use App\Models\UserOracleReading;
use App\Models\User;
use App\Models\Kin;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserOracleReadingFactory extends Factory
{
    protected $model = UserOracleReading::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'kin_id' => Kin::factory(),
            'oracle_data' => function () {
                return [
                    'destiny' => rand(1, 260),
                    'guide' => rand(1, 260),
                    'analog' => rand(1, 260),
                    'antipode' => rand(1, 260),
                    'occult' => rand(1, 260),
                ];
            },
            'interpretation' => $this->faker->sentence(),
            'is_favorite' => $this->faker->boolean(),
        ];
    }
}
