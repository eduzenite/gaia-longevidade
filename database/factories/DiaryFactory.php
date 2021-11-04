<?php

namespace Database\Factories;

use App\Models\Diary;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiaryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Diary::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'appointment' => date('Y-m-d H:i:s'),
            'description' => $this->faker->sentence(500, true),
            'feeling' => rand(1, 9)
        ];
    }
}
