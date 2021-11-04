<?php

namespace Tests\Feature\Menu\Positive;

use App\Models\Menu;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class MenuTest extends TestCase
{
    /**
     * @test
     */
    public function testListMenu()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('menu.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateMenu()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $data = [
            'user_id' => User::factory()->create()->id,
            'doctor_id' => User::factory()->create()->id,
            'validity' => date('Y-m-d'),
            'comments' => $faker->sentence(100, true)
        ];
        $response = $this->post(route('menu.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'validity', 'comments'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsMenu()
    {
        $this->withoutExceptionHandling();
        $Menu = Menu::factory()->create();
        $response = $this->get(route('menu.show', ['id' => $Menu->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'validity', 'comments'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateMenu()
    {
        $this->withoutExceptionHandling();
        $Menu = Menu::factory()->create();
        $faker = Faker::create();
        $data = [
            'validity' => date('Y-m-d'),
            'comments' => $faker->sentence(100, true)
        ];
        $response = $this->put(route('menu.update', ['id' => $Menu->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'validity', 'comments'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteMenu()
    {
        $this->withoutExceptionHandling();
        $Menu = Menu::factory()->create();
        $response = $this->delete(route('menu.destroy', ['id' => $Menu->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }

}
