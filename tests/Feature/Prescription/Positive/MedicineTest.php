<?php

namespace Tests\Feature\Prescription\Positive;

use App\Models\Medicine;
use App\Models\Prescription;
use Faker\Factory as Faker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class MedicineTest extends TestCase
{
    /**
     * @test
     */
    public function testListMedicine()
    {
        $this->withoutExceptionHandling();
        $Prescription = Prescription::factory()->create();
        $response = $this->get(route('medicines.index', ['prescriptionId' => $Prescription->id]));
        $response->assertStatus(200);
        $fields = ['message', 'status', 'current_page', 'data', 'to', 'total', 'first_page_url', 'from', 'last_page', 'last_page_url', 'links', 'next_page_url', 'path', 'per_page', 'prev_page_url'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateMedicine()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $data = [
            'prescription_id' => Prescription::factory()->create()->id,
            'title' => $faker->sentence(100, true),
            'dosage' => $faker->sentence(100, true),
            'schedules' => $faker->sentence(100, true),
            'quantity' => $faker->sentence(100, true),
        ];
        $Prescription = Prescription::factory()->create();
        $response = $this->post(route('medicines.store', ['prescriptionId' => $Prescription->id]), $data);
        $response->assertStatus(201);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'prescription_id', 'title', 'dosage', 'schedules', 'quantity'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsMedicine()
    {
        $this->withoutExceptionHandling();
        $Medicine = Medicine::factory()->create();
        $response = $this->get(route('medicines.show', ['id' => $Medicine->id]));
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'prescription_id', 'title', 'dosage', 'schedules', 'quantity'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateMedicine()
    {
        $this->withoutExceptionHandling();
        $Medicine = Medicine::factory()->create();
        $faker = Faker::create();
        $data = [
            'prescription_id' => Prescription::factory()->create()->id,
            'title' => $faker->sentence(100, true),
            'dosage' => $faker->sentence(100, true),
            'schedules' => $faker->sentence(100, true),
            'quantity' => $faker->sentence(100, true),
        ];
        $response = $this->put(route('medicines.update', ['id' => $Medicine->id]), $data);
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'updated', 'prescription_id', 'title', 'dosage', 'schedules', 'quantity'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteMedicine()
    {
        $this->withoutExceptionHandling();
        $Medicine = Medicine::factory()->create();
        $response = $this->delete(route('medicines.destroy', ['id' => $Medicine->id]));
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Deleted']);
    }
}
