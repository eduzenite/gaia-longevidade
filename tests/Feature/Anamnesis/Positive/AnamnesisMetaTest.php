<?php

namespace Tests\Feature\Anamnesis\Positive;

use App\Models\Anamnesis;
use App\Models\AnamnesisMeta;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AnamnesisMetaTest extends TestCase
{
    /**
     * @test
     */
    public function testListAnamnesisMeta()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Anamnesis = Anamnesis::factory()->create();
        $response = $this->get(route('anamnesismetas.index', ['anamnesisId' => $Anamnesis->id]));
        $response->assertStatus(200);
        $fields = ['message', 'status', 'current_page', 'data', 'to', 'total', 'first_page_url', 'from', 'last_page', 'last_page_url', 'links', 'next_page_url', 'path', 'per_page', 'prev_page_url'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateAnamnesisMeta()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Anamnesis = Anamnesis::factory()->create();
        $faker = Faker::create();
        $data = [
            'anamnesis_id' => Anamnesis::factory()->create()->id,
            'meta' => $faker->sentence(5, true),
            'value' => $faker->sentence(500, true),
        ];
        $response = $this->post(route('anamnesismetas.store', ['anamnesisId' => $Anamnesis->id]), $data);
        $response->assertStatus(201);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'anamnesis_id', 'meta', 'value'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsAnamnesisMeta()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $AnamnesisMeta = AnamnesisMeta::factory()->create();
        $response = $this->get(route('anamnesismetas.show', ['anamnesisId' => $AnamnesisMeta->anamnesis_id, 'anamnesisMetaId' => $AnamnesisMeta->id]));
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'anamnesis_id', 'meta', 'value'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateAnamnesisMeta()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $AnamnesisMeta = AnamnesisMeta::factory()->create();
        $faker = Faker::create();
        $data = [
            'anamnesis_id' => Anamnesis::factory()->create()->id,
            'meta' => $faker->sentence(5, true),
            'value' => $faker->sentence(500, true),
        ];
        $response = $this->put(route('anamnesismetas.update', ['anamnesisId' => $AnamnesisMeta->anamnesis_id, 'anamnesisMetaId' => $AnamnesisMeta->id]), $data);
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'updated', 'anamnesis_id', 'meta', 'value'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteAnamnesisMeta()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $AnamnesisMeta = AnamnesisMeta::factory()->create();
        $response = $this->delete(route('anamnesismetas.destroy', ['anamnesisId' => $AnamnesisMeta->anamnesis_id, 'anamnesisMetaId' => $AnamnesisMeta->id]));
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Deleted']);
    }

}
