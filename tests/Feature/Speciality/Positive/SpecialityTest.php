<?php

namespace Tests\Feature\Speciality\Positive;

use App\Models\Speciality;
use Faker\Factory as Faker;
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
        $response = $this->get(route('specialities.index'));
        $response->assertStatus(200);
        $fields = ['message', 'status', 'current_page', 'data', 'to', 'total', 'first_page_url', 'from', 'last_page', 'last_page_url', 'links', 'next_page_url', 'path', 'per_page', 'prev_page_url'];
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
            'title' => json_encode(["pt_BR" => $faker->sentence(5, true), "en_US" => $faker->sentence(5, true)]),
        ];
        $response = $this->post(route('specialities.store'), $data);
        $response->assertStatus(201);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'title'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsSpeciality()
    {
        $this->withoutExceptionHandling();
        $Speciality = Speciality::factory()->create();
        $response = $this->get(route('specialities.show', ['specialityId' => $Speciality->id]));
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'title'];
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
            'title' => json_encode(["pt_BR" => $faker->sentence(5, true), "en_US" => $faker->sentence(5, true)]),
        ];
        $response = $this->put(route('specialities.update', ['specialityId' => $Speciality->id]), $data);
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'updated', 'title'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteSpeciality()
    {
        $this->withoutExceptionHandling();
        $Speciality = Speciality::factory()->create();
        $response = $this->delete(route('specialities.destroy', ['specialityId' => $Speciality->id]));
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Deleted']);
    }
}
