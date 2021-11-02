<?php

namespace Database\Factories;

use App\Models\Anamnesis;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnamnesisMetaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'anamnesis_id' => Anamnesis::factory(),
            'meta' => $this->faker->sentence(5, true),
            'value' => $this->faker->sentence(500, true),
        ];
    }
}
