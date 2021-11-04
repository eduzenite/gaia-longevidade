<?php

namespace Tests\Feature\Diary\Positive;

use App\Models\Diary;
use App\Models\DiaryMeta;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class DiaryMetaTest extends TestCase
{
    /**
     * @test
     */
    public function testListDiaryMeta()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('diarymeta.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateDiaryMeta()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $data = [
            'diary_id' => Diary::factory()->create()->id,
            'meta' => $faker->sentence(5, true),
            'value' => json_encode(['value1' => $faker->sentence(50, true), 'value2' => $faker->sentence(50, true)]),
        ];
        $response = $this->post(route('diarymeta.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'diary_id', 'meta', 'value'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsDiaryMeta()
    {
        $this->withoutExceptionHandling();
        $DiaryMeta = DiaryMeta::factory()->create();
        $response = $this->get(route('diarymeta.show', ['id' => $DiaryMeta->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'diary_id', 'meta', 'value'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateDiaryMeta()
    {
        $this->withoutExceptionHandling();
        $DiaryMeta = DiaryMeta::factory()->create();
        $faker = Faker::create();
        $data = [
            'meta' => $faker->sentence(5, true),
            'value' => json_encode(['value1' => $faker->sentence(50, true), 'value2' => $faker->sentence(50, true)]),
        ];
        $response = $this->put(route('diarymeta.update', ['id' => $DiaryMeta->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'diary_id', 'meta', 'value'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteDiaryMeta()
    {
        $this->withoutExceptionHandling();
        $DiaryMeta = DiaryMeta::factory()->create();
        $response = $this->delete(route('diarymeta.destroy', ['id' => $DiaryMeta->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }
}
