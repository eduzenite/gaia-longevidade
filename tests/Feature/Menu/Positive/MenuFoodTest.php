<?php

namespace Tests\Feature\Menu\Positive;

use App\Models\Menu;
use App\Models\MenuFood;
use Faker\Factory as Faker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class MenuFoodTest extends TestCase
{
    /**
     * @test
     */
    public function testListMenuFood()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('menufood.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateMenuFood()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $data = [
            'menu_id' => Menu::factory()->create()->id,
            'title' => $faker->sentence(20, true),
            'amount' => rand(50, 200).' g',
            'calorie' => rand(550, 1000).' calorias',
            'time' => json_encode([rand(1, 4), rand(5, 8)])
        ];
        $response = $this->post(route('menufood.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'menu_id', 'title', 'amount', 'calorie', 'time'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsMenuFood()
    {
        $this->withoutExceptionHandling();
        $MenuFood = MenuFood::factory()->create();
        $response = $this->get(route('menufood.show', ['id' => $MenuFood->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'menu_id', 'title', 'amount', 'calorie', 'time'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateMenuFood()
    {
        $this->withoutExceptionHandling();
        $MenuFood = MenuFood::factory()->create();
        $faker = Faker::create();
        $data = [
            'title' => $faker->sentence(20, true),
            'amount' => rand(50, 200).' g',
            'calorie' => rand(550, 1000).' calorias',
            'time' => json_encode([rand(1, 4), rand(5, 8)])
        ];
        $response = $this->put(route('menufood.update', ['id' => $MenuFood->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'menu_id', 'title', 'amount', 'calorie', 'time'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteMenuFood()
    {
        $this->withoutExceptionHandling();
        $MenuFood = MenuFood::factory()->create();
        $response = $this->delete(route('menufood.destroy', ['id' => $MenuFood->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }
}
