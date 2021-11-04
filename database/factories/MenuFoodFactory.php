<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'menu_id' => Menu::factory(),
            'title' => $this->faker->sentence(20, true),
            'amount' => rand(50, 200).' g',
            'calorie' => rand(550, 1000).' calorias',
            'time' => json_encode([rand(1, 4), rand(5, 8)])
        ];
    }
}
