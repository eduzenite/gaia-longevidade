<?php

namespace Tests\Feature\User\Positive;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function testListUser()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('user.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateUser()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $filePath = 'storage/app/public/test/';
        $data = [
            'name' => $faker->name(),
            'photo' => $faker->image($filePath,500,500),
            'phone' => $faker->phoneNumber,
            'email' => $faker->unique()->safeEmail(),
            'role' => rand(1, 4),
            'timezone' => $faker->timezone,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
        $response = $this->post(route('user.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'name', 'photo', 'phone', 'email', 'password', 'role', 'timezone'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsUser()
    {
        $this->withoutExceptionHandling();
        $User = User::factory()->create();
        $response = $this->get(route('user.show', ['id' => $User->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'name', 'photo', 'phone', 'email', 'password', 'role', 'timezone'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateUser()
    {
        $this->withoutExceptionHandling();
        $User = User::factory()->create();
        $faker = Faker::create();
        $filePath = 'storage/app/public/test/';
        $data = [
            'name' => $faker->name(),
            'photo' => $faker->image($filePath,500,500),
            'phone' => $faker->phoneNumber,
            'email' => $faker->unique()->safeEmail(),
            'role' => rand(1, 4),
            'timezone' => $faker->timezone,
        ];
        $response = $this->put(route('user.update', ['id' => $User->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'name', 'photo', 'phone', 'email', 'role', 'timezone'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteUser()
    {
        $this->withoutExceptionHandling();
        $User = User::factory()->create();
        $response = $this->delete(route('user.destroy', ['id' => $User->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }
}
