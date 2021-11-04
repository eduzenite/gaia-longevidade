<?php

namespace Tests\Feature\Anamnesis\Positive;

use App\Models\Anamnesis;
use App\Models\AnamnesisMeta;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AnamnesisMetaTest extends TestCase
{
    /**
     * @test
     */
    public function testListAnamnesisMeta()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('anamnesismeta.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateAnamnesisMeta()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $data = [
            'anamnesis_id' => Anamnesis::factory()->create()->id,
            'meta' => $faker->sentence(5, true),
            'value' => $faker->sentence(500, true),
        ];
        $response = $this->post(route('anamnesismeta.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'anamnesis_id', 'meta', 'value'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsAnamnesisMeta()
    {
        $this->withoutExceptionHandling();
        $AnamnesisMeta = AnamnesisMeta::factory()->create();
        $response = $this->get(route('anamnesismeta.show', ['id' => $AnamnesisMeta->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'anamnesis_id', 'meta', 'value'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateAnamnesisMeta()
    {
        $this->withoutExceptionHandling();
        $AnamnesisMeta = AnamnesisMeta::factory()->create();
        $faker = Faker::create();
        $data = [
            'anamnesis_id' => Anamnesis::factory()->create()->id,
            'meta' => $faker->sentence(5, true),
            'value' => $faker->sentence(500, true),
        ];
        $response = $this->put(route('anamnesismeta.update', ['id' => $AnamnesisMeta->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'anamnesis_id', 'meta', 'value'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteAnamnesisMeta()
    {
        $this->withoutExceptionHandling();
        $AnamnesisMeta = AnamnesisMeta::factory()->create();
        $response = $this->delete(route('anamnesismeta.destroy', ['id' => $AnamnesisMeta->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }
}
