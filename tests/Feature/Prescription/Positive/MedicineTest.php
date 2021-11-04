<?php

namespace Tests\Feature\Prescription\Positive;

use App\Models\Medicine;
use App\Models\Prescription;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $response = $this->get(route('medicine.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
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
        $response = $this->post(route('medicine.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'prescription_id', 'title', 'dosage', 'schedules', 'quantity'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsMedicine()
    {
        $this->withoutExceptionHandling();
        $Medicine = Medicine::factory()->create();
        $response = $this->get(route('medicine.show', ['id' => $Medicine->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'prescription_id', 'title', 'dosage', 'schedules', 'quantity'];
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
            'title' => $faker->sentence(100, true),
            'dosage' => $faker->sentence(100, true),
            'schedules' => $faker->sentence(100, true),
            'quantity' => $faker->sentence(100, true),
        ];
        $response = $this->put(route('medicine.update', ['id' => $Medicine->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'prescription_id', 'title', 'dosage', 'schedules', 'quantity'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteMedicine()
    {
        $this->withoutExceptionHandling();
        $Medicine = Medicine::factory()->create();
        $response = $this->delete(route('medicine.destroy', ['id' => $Medicine->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }
}
