<?php

namespace Tests\Feature\User\Positive;

use App\Models\User;
use App\Models\UserAvailability;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserAvailabilityTest extends TestCase
{
    /**
     * @test
     */
    public function testListUserAvailability()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('useravailability.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateUserAvailability()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $data = [
            'user_id' => User::factory()->create()->id,
            'weekday' => rand(1, 7),
            'start_time' => $faker->time('H:i'),
            'end_time' => $faker->time('H:i'),
        ];
        $response = $this->post(route('useravailability.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'weekday', 'start_time', 'end_time'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsUserAvailability()
    {
        $this->withoutExceptionHandling();
        $UserAvailability = UserAvailability::factory()->create();
        $response = $this->get(route('useravailability.show', ['id' => $UserAvailability->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'weekday', 'start_time', 'end_time'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateUserAvailability()
    {
        $this->withoutExceptionHandling();
        $UserAvailability = UserAvailability::factory()->create();
        $faker = Faker::create();
        $data = [
            'weekday' => rand(1, 7),
            'start_time' => $faker->time('H:i'),
            'end_time' => $faker->time('H:i'),
        ];
        $response = $this->put(route('useravailability.update', ['id' => $UserAvailability->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'weekday', 'start_time', 'end_time'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteUserAvailability()
    {
        $this->withoutExceptionHandling();
        $UserAvailability = UserAvailability::factory()->create();
        $response = $this->delete(route('useravailability.destroy', ['id' => $UserAvailability->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }

}
