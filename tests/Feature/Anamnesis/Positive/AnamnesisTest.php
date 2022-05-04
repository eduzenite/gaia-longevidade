<?php

namespace Tests\Feature\Anamnesis\Positive;

use App\Models\Anamnesis;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AnamnesisTest extends TestCase
{
    /**
     * @test
     */
    public function testListAnamnesis()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $response = $this->get(route('anamnesis.index'));
        $response->assertStatus(200);
        $fields = ['message', 'status', 'current_page', 'data', 'to', 'total', 'first_page_url', 'from', 'last_page', 'last_page_url', 'links', 'next_page_url', 'path', 'per_page', 'prev_page_url'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateAnamnesis()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $data = [
            'user_id' => User::factory()->create()->id,
            'doctor_id' => User::factory()->create()->id,
            'attendance_id' => Attendance::factory()->create()->id,
        ];
        $response = $this->post(route('anamnesis.store'), $data);
        $response->assertStatus(201);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'attendance_id'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsAnamnesis()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Anamnesis = Anamnesis::factory()->create();
        $response = $this->get(route('anamnesis.show', ['anamnesisId' => $Anamnesis->id]));
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'attendance_id'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateAnamnesis()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Anamnesis = Anamnesis::factory()->create();
        $data = [
            'user_id' => User::factory()->create()->id,
            'doctor_id' => User::factory()->create()->id,
            'attendance_id' => Attendance::factory()->create()->id,
        ];
        $response = $this->put(route('anamnesis.update', ['anamnesisId' => $Anamnesis->id]), $data);
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'updated', 'user_id', 'doctor_id', 'attendance_id'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteAnamnesis()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Anamnesis = Anamnesis::factory()->create();
        $response = $this->delete(route('anamnesis.destroy', ['anamnesisId' => $Anamnesis->id]));
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Deleted']);
    }
}
