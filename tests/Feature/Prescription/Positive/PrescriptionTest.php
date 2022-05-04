<?php

namespace Tests\Feature\Prescription\Positive;

use App\Models\Prescription;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PrescriptionTest extends TestCase
{
    /**
     * @test
     */
    public function testListPrescription()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $response = $this->get(route('prescriptions.index'));
        $response->assertStatus(200);
        $fields = ['message', 'status', 'current_page', 'data', 'to', 'total', 'first_page_url', 'from', 'last_page', 'last_page_url', 'links', 'next_page_url', 'path', 'per_page', 'prev_page_url'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreatePrescription()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $data = [
            'user_id' => User::factory()->create()->id,
            'doctor_id' => User::factory()->create()->id,
            'comments' => $faker->sentence(500, true),
        ];
        $response = $this->post(route('prescriptions.store'), $data);
        $response->assertStatus(201);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'hash', 'comments'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsPrescription()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Prescription = Prescription::factory()->create();
        $response = $this->get(route('prescriptions.show', ['prescriptionId' => $Prescription->id]));
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'hash', 'comments'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdatePrescription()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Prescription = Prescription::factory()->create();
        $faker = Faker::create();
        $data = [
            'comments' => $faker->sentence(500, true),
        ];
        $response = $this->put(route('prescriptions.update', ['prescriptionId' => $Prescription->id]), $data);
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'updated', 'user_id', 'doctor_id', 'hash', 'comments'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeletePrescription()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Prescription = Prescription::factory()->create();
        $response = $this->delete(route('prescriptions.destroy', ['prescriptionId' => $Prescription->id]));
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Deleted']);
    }
}
