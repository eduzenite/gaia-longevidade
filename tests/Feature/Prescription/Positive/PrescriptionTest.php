<?php

namespace Tests\Feature\Prescription\Positive;

use App\Models\Prescription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PrescriptionTest extends TestCase
{
    /**
     * @test
     */
    public function testListPrescription()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('prescription.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreatePrescription()
    {
        $this->withoutExceptionHandling();
        $data = [
            'user_id' => User::factory()->create()->id,
            'doctor_id' => User::factory()->create()->id,
            'hash' => $this->faker->sha256,
            'comments' => $this->faker->sentence(500, true)
        ];
        $response = $this->post(route('prescription.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'hash', 'comments'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsPrescription()
    {
        $this->withoutExceptionHandling();
        $Prescription = Prescription::factory()->create();
        $response = $this->get(route('prescription.show', ['id' => $Prescription->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'hash', 'comments'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdatePrescription()
    {
        $this->withoutExceptionHandling();
        $Prescription = Prescription::factory()->create();
        $data = [
            'comments' => $this->faker->sentence(500, true)
        ];
        $response = $this->put(route('prescription.update', ['id' => $Prescription->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'hash', 'comments'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeletePrescription()
    {
        $this->withoutExceptionHandling();
        $Prescription = Prescription::factory()->create();
        $response = $this->delete(route('prescription.destroy', ['id' => $Prescription->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }
}
