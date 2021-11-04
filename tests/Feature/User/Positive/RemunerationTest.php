<?php

namespace Tests\Feature\User\Positive;

use App\Models\Attendance;
use App\Models\Remuneration;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class RemunerationTest extends TestCase
{
    /**
     * @test
     */
    public function testListRemuneration()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('remuneration.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateRemuneration()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $data = [
            'user_id' => User::factory()->create()->id,
            'doctor_id' => User::factory()->create()->id,
            'attendance_id' => Attendance::factory()->create()->id,
            'status' => rand(1, 13),
            'amount' => $faker->randomFloat($nbMaxDecimals = 2, $min = 150, $max = 350)
        ];
        $response = $this->post(route('remuneration.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'attendance_id', 'status', 'amount'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsRemuneration()
    {
        $this->withoutExceptionHandling();
        $Remuneration = Remuneration::factory()->create();
        $response = $this->get(route('remuneration.show', ['id' => $Remuneration->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'attendance_id', 'status', 'amount'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateRemuneration()
    {
        $this->withoutExceptionHandling();
        $Remuneration = Remuneration::factory()->create();
        $data = [
            'status' => rand(1, 13),
        ];
        $response = $this->put(route('remuneration.update', ['id' => $Remuneration->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'attendance_id', 'status', 'amount'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteRemuneration()
    {
        $this->withoutExceptionHandling();
        $Remuneration = Remuneration::factory()->create();
        $response = $this->delete(route('remuneration.destroy', ['id' => $Remuneration->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }
}
