<?php

namespace Tests\Feature\Diary\Positive;

use App\Models\Diary;
use App\Models\DiaryMeta;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DiaryMetaTest extends TestCase
{
    /**
     * @test
     */
    public function testListDiaryMeta()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Diary = Diary::factory()->create();
        $response = $this->get(route('diarymetas.index', ['diaryId' => $Diary->id]));
        $response->assertStatus(200);
        $fields = ['message', 'status', 'current_page', 'data', 'to', 'total', 'first_page_url', 'from', 'last_page', 'last_page_url', 'links', 'next_page_url', 'path', 'per_page', 'prev_page_url'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateDiaryMeta()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $data = [
            'diary_id' => Diary::factory()->create()->id,
            'meta' => $faker->sentence(5, true),
            'value' => json_encode(["value1" => $faker->sentence(50, true), "value2" => $faker->sentence(50, true)]),
        ];
        $Diary = Diary::factory()->create();
        $response = $this->post(route('diarymetas.store', ['diaryId' => $Diary->id]), $data);
        $response->assertStatus(201);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'diary_id', 'meta', 'value'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsDiaryMeta()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $DiaryMeta = DiaryMeta::factory()->create();
        $response = $this->get(route('diarymetas.show', ['diaryId' => $DiaryMeta->diary_id,'diaryMetaId' => $DiaryMeta->id]));
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'diary_id', 'meta', 'value'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateDiaryMeta()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $DiaryMeta = DiaryMeta::factory()->create();
        $faker = Faker::create();
        $data = [
            'diary_id' => Diary::factory()->create()->id,
            'meta' => $faker->sentence(5, true),
            'value' => json_encode(["value1" => $faker->sentence(50, true), "value2" => $faker->sentence(50, true)]),
        ];
        $response = $this->put(route('diarymetas.update', ['diaryId' => $DiaryMeta->diary_id,'diaryMetaId' => $DiaryMeta->id]), $data);
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'updated', 'diary_id', 'meta', 'value'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteDiaryMeta()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $DiaryMeta = DiaryMeta::factory()->create();
        $response = $this->delete(route('diarymetas.destroy', ['diaryId' => $DiaryMeta->diary_id,'diaryMetaId' => $DiaryMeta->id]));
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Deleted']);
    }
}
