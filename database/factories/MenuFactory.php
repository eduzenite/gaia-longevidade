<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
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
            'validity' => date('Y-m-d'),
            'comments' => $this->faker->sentence(100, true)
        ];
    }
}
