<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserMetaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'meta' => $this->faker->sentence(5, true),
            'value' => json_encode(['value1' => $this->faker->sentence(50, true), 'value2' => $this->faker->sentence(50, true)]),
        ];
    }
}
