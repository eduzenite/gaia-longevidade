<?php

namespace Tests\Feature\User\Positive;

use App\Models\User;
use App\Models\UserMeta;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserMetaTest extends TestCase
{
    /**
     * @test
     */
    public function testListUserMeta()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('usermeta.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateUserMeta()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $data = [
            'user_id' => User::factory()->create()->id,
            'meta' => $faker->sentence(5, true),
            'value' => json_encode(['value1' => $faker->sentence(50, true), 'value2' => $faker->sentence(50, true)]),
        ];
        $response = $this->post(route('usermeta.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'meta', 'value'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsUserMeta()
    {
        $this->withoutExceptionHandling();
        $UserMeta = UserMeta::factory()->create();
        $response = $this->get(route('usermeta.show', ['id' => $UserMeta->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'meta', 'value'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateUserMeta()
    {
        $this->withoutExceptionHandling();
        $UserMeta = UserMeta::factory()->create();
        $faker = Faker::create();
        $data = [
            'meta' => $faker->sentence(5, true),
            'value' => json_encode(['value1' => $faker->sentence(50, true), 'value2' => $faker->sentence(50, true)]),
        ];
        $response = $this->put(route('usermeta.update', ['id' => $UserMeta->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'meta', 'value'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteUserMeta()
    {
        $this->withoutExceptionHandling();
        $UserMeta = UserMeta::factory()->create();
        $response = $this->delete(route('usermeta.destroy', ['id' => $UserMeta->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }
}
