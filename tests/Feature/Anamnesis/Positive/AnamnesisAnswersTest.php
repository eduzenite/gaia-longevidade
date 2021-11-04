<?php

namespace Tests\Feature\Anamnesis\Positive;

use App\Models\AnamnesisAnswers;
use App\Models\AnamnesisQuestions;
use Faker\Factory as Faker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AnamnesisAnswersTest extends TestCase
{

    /**
     * @test
     */
    public function testListAnamnesisAnswers()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('anamnesisanswers.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateAnamnesisAnswers()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $answes = ['pt_BR' => [$faker->sentence(2, true), 'en_US' => $faker->sentence(3, true)]];
        $data = [
            'anamnesis_question_id' => AnamnesisQuestions::factory()->create()->id,
            'answers' => $answes,
        ];
        $response = $this->post(route('anamnesisanswers.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'anamnesis_question_id', 'answers'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsAnamnesisAnswers()
    {
        $this->withoutExceptionHandling();
        $AnamnesisAnswers = AnamnesisAnswers::factory()->create();
        $response = $this->get(route('anamnesisanswers.show', ['id' => $AnamnesisAnswers->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'anamnesis_question_id', 'answers'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateAnamnesisAnswers()
    {
        $this->withoutExceptionHandling();
        $AnamnesisAnswers = AnamnesisAnswers::factory()->create();
        $faker = Faker::create();
        $answes = ['pt_BR' => [$faker->sentence(2, true), 'en_US' => $faker->sentence(3, true)]];
        $data = [
            'anamnesis_question_id' => AnamnesisQuestions::factory()->create()->id,
            'answers' => $answes,
        ];
        $response = $this->put(route('anamnesisanswers.update', ['id' => $AnamnesisAnswers->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'anamnesis_question_id', 'answers'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteAnamnesisAnswers()
    {
        $this->withoutExceptionHandling();
        $AnamnesisAnswers = AnamnesisAnswers::factory()->create();
        $response = $this->delete(route('anamnesisanswers.destroy', ['id' => $AnamnesisAnswers->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }
}
