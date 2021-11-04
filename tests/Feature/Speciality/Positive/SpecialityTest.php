<?php

namespace Tests\Feature\Speciality\Positive;

use App\Models\Speciality;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class SpecialityTest extends TestCase
{
    /**
     * @test
     */
    public function testListSpeciality()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('speciality.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateSpeciality()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $data = [
            'title' => json_encode(['pt_BR' => $faker->sentence(5, true)]),
        ];
        $response = $this->post(route('speciality.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'title'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsSpeciality()
    {
        $this->withoutExceptionHandling();
        $Speciality = Speciality::factory()->create();
        $response = $this->get(route('speciality.show', ['id' => $Speciality->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'title'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateSpeciality()
    {
        $this->withoutExceptionHandling();
        $Speciality = Speciality::factory()->create();
        $faker = Faker::create();
        $data = [
            'title' => json_encode(['pt_BR' => $faker->sentence(5, true)]),
        ];
        $response = $this->put(route('speciality.update', ['id' => $Speciality->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'title'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteSpeciality()
    {
        $this->withoutExceptionHandling();
        $Speciality = Speciality::factory()->create();
        $response = $this->delete(route('speciality.destroy', ['id' => $Speciality->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }

}
