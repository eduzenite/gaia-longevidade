<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RemunerationFactory extends Factory
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
            'attendance_id' => Attendance::factory(),
            'status' => rand(1, 13),
            'amount' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 150, $max = 350)
        ];
    }
}
