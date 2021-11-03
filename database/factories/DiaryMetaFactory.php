<?php

namespace Database\Factories;

use App\Models\Diary;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiaryMetaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'diary_id' => Diary::factory(),
            'meta' => $this->faker->sentence(5, true),
            'value' => json_encode(['value1' => $this->faker->sentence(50, true), 'value2' => $this->faker->sentence(50, true)]),
        ];
    }
}
