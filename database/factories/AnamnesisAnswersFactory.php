<?php

namespace Database\Factories;

use App\Models\AnamnesisQuestions;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnamnesisAnswersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $item = ['pt_BR' => [$this->faker->sentence(2, true), $this->faker->sentence(3, true)]];
        return [
            'anamnesis_question_id' => AnamnesisQuestions::factory(),
            'answers' => json_encode($item)
        ];
    }
}
