<?php

namespace Tests\Feature\Anamnesis\Positive;

use App\Models\Anamnesis;
use App\Models\AnamnesisAnswers;
use App\Models\AnamnesisQuestions;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AnamnesisAnswersTest extends TestCase
{
    /**
     * @test
     */
    public function testListAnamnesisAnswers()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $AnamnesisAnswers = AnamnesisAnswers::factory()->create();
        $response = $this->get(route('anamnesisanswers.index', ['anamnesisQuestionId' => $AnamnesisAnswers->anamnesis_question_id]));
        $response->assertStatus(200);
        $fields = ['message', 'status', 'current_page', 'data', 'to', 'total', 'first_page_url', 'from', 'last_page', 'last_page_url', 'links', 'next_page_url', 'path', 'per_page', 'prev_page_url'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateAnamnesisAnswers()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $AnamnesisQuestions = AnamnesisQuestions::factory()->create();
        $data = [
            'anamnesis_question_id' => $AnamnesisQuestions->id,
            'answers' => json_encode(["pt_BR" => [$faker->sentence(2, true), "en_US" => $faker->sentence(3, true)]]),
        ];
        $response = $this->post(route('anamnesisanswers.store', ['anamnesisQuestionId' => $AnamnesisQuestions->id]), $data);
        $response->assertStatus(201);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'anamnesis_question_id', 'answers'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsAnamnesisAnswers()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $AnamnesisAnswers = AnamnesisAnswers::factory()->create();
        $response = $this->get(route('anamnesisanswers.show', ['anamnesisQuestionId' => $AnamnesisAnswers->anamnesis_question_id, 'anamnesisQuestionAnswerId' => $AnamnesisAnswers->id]));
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'anamnesis_question_id', 'answers'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateAnamnesisAnswers()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $AnamnesisAnswers = AnamnesisAnswers::factory()->create();
        $faker = Faker::create();
        $data = [
            'anamnesis_question_id' => AnamnesisQuestions::factory()->create()->id,
            'answers' => json_encode(["pt_BR" => [$faker->sentence(2, true), "en_US" => $faker->sentence(3, true)]]),
        ];
        $response = $this->put(route('anamnesisanswers.update', ['anamnesisQuestionId' => $AnamnesisAnswers->anamnesis_question_id, 'anamnesisQuestionAnswerId' => $AnamnesisAnswers->id]), $data);
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'updated', 'anamnesis_question_id', 'answers'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteAnamnesisAnswers()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $AnamnesisAnswers = AnamnesisAnswers::factory()->create();
        $response = $this->delete(route('anamnesisanswers.destroy', ['anamnesisQuestionId' => $AnamnesisAnswers->anamnesis_question_id, 'anamnesisQuestionAnswerId' => $AnamnesisAnswers->id]));
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Deleted']);
    }
}
