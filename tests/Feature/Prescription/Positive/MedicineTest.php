<?php

namespace Tests\Feature\Prescription\Positive;

use App\Models\Medicine;
use App\Models\Prescription;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class MedicineTest extends TestCase
{
    /**
     * @test
     */
    public function testListMedicine()
    {
        Sanctum::actingAs(User::factory()->create());
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
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $data = [
            'title' => $faker->sentence(20, true),
            'dosage' => $faker->sentence(20, true),
            'schedules' => $faker->sentence(20, true),
            'quantity' => $faker->sentence(20, true),
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
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Medicine = Medicine::factory()->create();
        $response = $this->get(route('medicines.show', ['prescriptionId' => $Medicine->prescription_id, 'prescriptionMedicineId' => $Medicine->id]));
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'prescription_id', 'title', 'dosage', 'schedules', 'quantity'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateMedicine()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Medicine = Medicine::factory()->create();
        $faker = Faker::create();
        $data = [
            'title' => $faker->sentence(20, true),
            'dosage' => $faker->sentence(20, true),
            'schedules' => $faker->sentence(20, true),
            'quantity' => $faker->sentence(20, true),
        ];
        $response = $this->put(route('medicines.update', ['prescriptionId' => $Medicine->prescription_id, 'prescriptionMedicineId' => $Medicine->id]), $data);
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'updated', 'prescription_id', 'title', 'dosage', 'schedules', 'quantity'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteMedicine()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Medicine = Medicine::factory()->create();
        $response = $this->delete(route('medicines.destroy', ['prescriptionId' => $Medicine->prescription_id, 'prescriptionMedicineId' => $Medicine->id]));
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Deleted']);
    }
}
