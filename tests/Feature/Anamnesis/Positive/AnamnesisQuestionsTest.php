<?php

namespace Tests\Feature\Anamnesis\Positive;

use App\Models\AnamnesisQuestions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateAnamnesisQuestions()
    {
        $this->withoutExceptionHandling();
        $data = [
            'type' => rand(1, 10),
            'question' => json_encode($question = ['en_US' => $this->faker->sentence(100, true), 'pt_BR' => $this->faker->sentence(100, true)]),
            'anamnesis_question_id' => AnamnesisQuestions::factory()->create()->id,
        ];
        $response = $this->post(route('anamnesisquestions.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'type', 'question', 'anamnesis_question_id'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsAnamnesisQuestions()
    {
        $this->withoutExceptionHandling();
        $AnamnesisQuestions = AnamnesisQuestions::factory()->create();
        $response = $this->get(route('anamnesisquestions.show', ['id' => $AnamnesisQuestions->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'type', 'question', 'anamnesis_question_id'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateAnamnesisQuestions()
    {
        $this->withoutExceptionHandling();
        $AnamnesisQuestions = AnamnesisQuestions::factory()->create();
        $data = [
            'type' => rand(1, 10),
            'question' => json_encode($question = ['en_US' => $this->faker->sentence(100, true), 'pt_BR' => $this->faker->sentence(100, true)]),
            'anamnesis_question_id' => AnamnesisQuestions::factory()->create()->id,
        ];
        $response = $this->put(route('anamnesisquestions.update', ['id' => $AnamnesisQuestions->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'type', 'question', 'anamnesis_question_id'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteAnamnesisQuestions()
    {
        $this->withoutExceptionHandling();
        $AnamnesisQuestions = AnamnesisQuestions::factory()->create();
        $response = $this->delete(route('anamnesisquestions.destroy', ['id' => $AnamnesisQuestions->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }
}
