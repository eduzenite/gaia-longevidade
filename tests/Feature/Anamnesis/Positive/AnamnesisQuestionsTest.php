<?php

namespace Tests\Feature\Anamnesis\Positive;

use App\Models\AnamnesisQuestions;
use Faker\Factory as Faker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AnamnesisQuestionsTest extends TestCase
{
    /**
     * @test
     */
    public function testListAnamnesisQuestions()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('anamnesisquestions.index'));
        $response->assertStatus(200);
        $fields = ['message', 'status', 'current_page', 'data', 'to', 'total', 'first_page_url', 'from', 'last_page', 'last_page_url', 'links', 'next_page_url', 'path', 'per_page', 'prev_page_url'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateAnamnesisQuestions()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $data = [
            'type' => rand(1, 10),
            'question' => json_encode(["en_US" => $faker->sentence(100, true), "pt_BR" => $faker->sentence(100, true)]),
            'anamnesis_question_id' => AnamnesisQuestions::factory()->create()->id,
        ];
        $response = $this->post(route('anamnesisquestions.store'), $data);
        $response->assertStatus(201);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'type', 'question', 'anamnesis_question_id'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsAnamnesisQuestions()
    {
        $this->withoutExceptionHandling();
        $AnamnesisQuestions = AnamnesisQuestions::factory()->create();
        $response = $this->get(route('anamnesisquestions.show', ['anamnesisQuestionId' => $AnamnesisQuestions->id]));
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'type', 'question', 'anamnesis_question_id'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateAnamnesisQuestions()
    {
        $this->withoutExceptionHandling();
        $AnamnesisQuestions = AnamnesisQuestions::factory()->create();
        $faker = Faker::create();
        $data = [
            'type' => rand(1, 10),
            'question' => json_encode(["en_US" => $faker->sentence(100, true), "pt_BR" => $faker->sentence(100, true)]),
            'anamnesis_question_id' => AnamnesisQuestions::factory()->create()->id,
        ];
        $response = $this->put(route('anamnesisquestions.update', ['anamnesisQuestionId' => $AnamnesisQuestions->id]), $data);
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'updated', 'type', 'question', 'anamnesis_question_id'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteAnamnesisQuestions()
    {
        $this->withoutExceptionHandling();
        $AnamnesisQuestions = AnamnesisQuestions::factory()->create();
        $response = $this->delete(route('anamnesisquestions.destroy', ['anamnesisQuestionId' => $AnamnesisQuestions->id]));
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Deleted']);
    }
}
