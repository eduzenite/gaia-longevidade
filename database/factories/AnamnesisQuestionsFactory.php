<?php

namespace Database\Factories;

use App\Models\AnamnesisQuestions;
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
        $type = rand(1, 10);
        return [
            'anamnesis_question_id' => AnamnesisQuestions::factory(),
            'type' => $type,
            'question' => json_encode($question),
        ];
    }
}
