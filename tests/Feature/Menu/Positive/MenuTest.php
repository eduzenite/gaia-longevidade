<?php

namespace Tests\Feature\Menu\Positive;

use App\Models\Menu;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class MenuTest extends TestCase
{
    /**
     * @test
     */
    public function testListMenu()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $response = $this->get(route('menus.index'));
        $response->assertStatus(200);
        $fields = ['message', 'status', 'current_page', 'data', 'to', 'total', 'first_page_url', 'from', 'last_page', 'last_page_url', 'links', 'next_page_url', 'path', 'per_page', 'prev_page_url'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateMenu()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $data = [
            'user_id' => User::factory()->create()->id,
            'doctor_id' => User::factory()->create()->id,
            'validity' => date("Y-m-d"),
            'comments' => $faker->sentence(100, true),
        ];
        $response = $this->post(route('menus.store'), $data);
        $response->assertStatus(201);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'validity', 'comments'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsMenu()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Menu = Menu::factory()->create();
        $response = $this->get(route('menus.show', ['menuId' => $Menu->id]));
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'validity', 'comments'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateMenu()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Menu = Menu::factory()->create();
        $faker = Faker::create();
        $data = [
            'user_id' => User::factory()->create()->id,
            'doctor_id' => User::factory()->create()->id,
            'validity' => date("Y-m-d"),
            'comments' => $faker->sentence(100, true),
        ];
        $response = $this->put(route('menus.update', ['menuId' => $Menu->id]), $data);
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'updated', 'user_id', 'doctor_id', 'validity', 'comments'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteMenu()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Menu = Menu::factory()->create();
        $response = $this->delete(route('menus.destroy', ['menuId' => $Menu->id]));
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Deleted']);
    }
}
