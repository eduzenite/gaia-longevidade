<?php

namespace Database\Factories;

use App\Models\Prescription;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'prescription_id' => Prescription::factory(),
            'title' => $this->faker->sentence(100, true),
            'dosage' => $this->faker->sentence(100, true),
            'schedules' => $this->faker->sentence(100, true),
            'quantity' => $this->faker->sentence(100, true),
        ];
    }
}
