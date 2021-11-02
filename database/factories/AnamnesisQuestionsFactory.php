<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnamnesisQuestionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $question = ['en_US' => $this->faker->sentence(100, true), 'pt_BR' => $this->faker->sentence(100, true)];
        return [
            'question' => json_encode($question)
        ];
    }
}
