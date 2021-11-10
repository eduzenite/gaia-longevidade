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
        $Menu = Menu::factory()->create();
        $response = $this->get(route('menufoods.index', ['menuId' => $Menu->id]));
        $response->assertStatus(200);
        $fields = ['message', 'status', 'current_page', 'data', 'to', 'total', 'first_page_url', 'from', 'last_page', 'last_page_url', 'links', 'next_page_url', 'path', 'per_page', 'prev_page_url'];
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
            'title' => $faker->sentence(20, true),
            'amount' => rand(50, 200)." g",
            'calorie' => rand(550, 1000)." calorias",
            'time' => json_encode([rand(1, 4), rand(5, 8)]),
        ];
        $Menu = Menu::factory()->create();
        $response = $this->post(route('menufoods.store', ['menuId' => $Menu->id]), $data);
        $response->assertStatus(201);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'menu_id', 'title', 'amount', 'calorie', 'time'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsMenuFood()
    {
        $this->withoutExceptionHandling();
        $MenuFood = MenuFood::factory()->create();
        $response = $this->get(route('menufoods.show', ['menuId' => $MenuFood->menu_id, 'menuFoodId' => $MenuFood->id]));
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'menu_id', 'title', 'amount', 'calorie', 'time'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateMenuFood()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $data = [
            'title' => $faker->sentence(20, true),
            'amount' => rand(50, 200)." g",
            'calorie' => rand(550, 1000)." calorias",
            'time' => json_encode([rand(1, 4), rand(5, 8)]),
        ];
        $MenuFood = MenuFood::factory()->create();
        $response = $this->put(route('menufoods.update', ['menuId' => $MenuFood->menu_id, 'menuFoodId' => $MenuFood->id]), $data);
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'updated', 'menu_id', 'title', 'amount', 'calorie', 'time'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteMenuFood()
    {
        $this->withoutExceptionHandling();
        $MenuFood = MenuFood::factory()->create();
        $response = $this->delete(route('menufoods.destroy', ['menuId' => $MenuFood->menu_id, 'menuFoodId' => $MenuFood->id]));
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Deleted']);
    }
}
