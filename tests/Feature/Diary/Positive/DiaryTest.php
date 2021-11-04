<?php

namespace Tests\Feature\Diary\Positive;

use App\Models\Diary;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class DiaryTest extends TestCase
{
    /**
     * @test
     */
    public function testListDiary()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('diary.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateDiary()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $data = [
            'user_id' => User::factory()->create()->id,
            'appointment' => date('Y-m-d H:i:s'),
            'description' => $faker->sentence(500, true),
            'feeling' => rand(1, 9)
        ];
        $response = $this->post(route('diary.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'appointment', 'description', 'feeling'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsDiary()
    {
        $this->withoutExceptionHandling();
        $Diary = Diary::factory()->create();
        $response = $this->get(route('diary.show', ['id' => $Diary->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'appointment', 'description', 'feeling'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateDiary()
    {
        $this->withoutExceptionHandling();
        $Diary = Diary::factory()->create();
        $faker = Faker::create();
        $data = [
            'appointment' => date('Y-m-d H:i:s'),
            'description' => $faker->sentence(500, true),
            'feeling' => rand(1, 9)
        ];
        $response = $this->put(route('diary.update', ['id' => $Diary->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'appointment', 'description', 'feeling'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteDiary()
    {
        $this->withoutExceptionHandling();
        $Diary = Diary::factory()->create();
        $response = $this->delete(route('diary.destroy', ['id' => $Diary->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }

    /**
     * @test
     */
    public function testFeelingsDiary()
    {
        $this->withoutExceptionHandling();
        $response = $this->put(route('diary.feelings'));
        $response->assertStatus(200);
    }

}
