<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrescriptionFactory extends Factory
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
            'doctor_id' => User::factory(),
            'hash' => $this->faker->sha256,
            'comments' => $this->faker->sentence(500, true)
        ];
    }
}
