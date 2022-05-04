<?php

namespace Tests\Feature\Diary\Positive;

use App\Models\Diary;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DiaryTest extends TestCase
{
    /**
     * @test
     */
    public function testListDiary()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $response = $this->get(route('diaries.index'));
        $response->assertStatus(200);
        $fields = ['message', 'status', 'current_page', 'data', 'to', 'total', 'first_page_url', 'from', 'last_page', 'last_page_url', 'links', 'next_page_url', 'path', 'per_page', 'prev_page_url'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateDiary()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $data = [
            'user_id' => User::factory()->create()->id,
            'appointment' => date("Y-m-d H:i:s"),
            'description' => $faker->sentence(500, true),
            'feeling' => rand(1, 9),
        ];
        $response = $this->post(route('diaries.store'), $data);
        $response->assertStatus(201);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'user_id', 'appointment', 'description', 'feeling'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsDiary()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Diary = Diary::factory()->create();
        $response = $this->get(route('diaries.show', ['diaryId' => $Diary->id]));
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'user_id', 'appointment', 'description', 'feeling'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateDiary()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Diary = Diary::factory()->create();
        $faker = Faker::create();
        $data = [
            'user_id' => User::factory()->create()->id,
            'appointment' => date("Y-m-d H:i:s"),
            'description' => $faker->sentence(500, true),
            'feeling' => rand(1, 9),
        ];
        $response = $this->put(route('diaries.update', ['diaryId' => $Diary->id]), $data);
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'updated', 'user_id', 'appointment', 'description', 'feeling'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteDiary()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Diary = Diary::factory()->create();
        $response = $this->delete(route('diaries.destroy', ['diaryId' => $Diary->id]));
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Deleted']);
    }
}
