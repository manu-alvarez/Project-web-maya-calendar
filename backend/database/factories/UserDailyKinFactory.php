<?php

namespace Database\Factories;

use App\Models\UserDailyKin;
use App\Models\User;
use App\Models\Kin;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserDailyKinFactory extends Factory
{
    protected $model = UserDailyKin::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'kin_id' => Kin::factory(),
            'wavespell_id' => $this->faker->numberBetween(1, 20),
            'castle_id' => $this->faker->numberBetween(1, 5),
            'date' => $this->faker->date(),
            'is_viewed' => true,
            'viewed_at' => $this->faker->dateTime(),
            'oracle_data' => function () {
                return [
                    'destiny' => rand(1, 260),
                    'guide' => rand(1, 260),
                    'analog' => rand(1, 260),
                    'antipode' => rand(1, 260),
                    'occult' => rand(1, 260),
                ];
            },
            'notes' => $this->faker->optional()->sentence(),
            'mood' => $this->faker->optional()->randomElement(['happy', 'sad', 'neutral', 'energetic', 'calm']),
        ];
    }
}
