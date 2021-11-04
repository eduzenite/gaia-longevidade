<?php

namespace Tests\Feature\Anamnesis\Positive;

use App\Models\Anamnesis;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AnamnesisTest extends TestCase
{
    /**
     * @test
     */
    public function testListAnamnesis()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('anamnesis.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateAnamnesis()
    {
        $this->withoutExceptionHandling();
        $data = [
            'user_id' => User::factory()->create()->id,
            'doctor_id' => User::factory()->create()->id,
            'attendance_id' => Attendance::factory()->create()->id,
        ];
        $response = $this->post(route('anamnesis.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'attendance_id'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsAnamnesis()
    {
        $this->withoutExceptionHandling();
        $Anamnesis = Anamnesis::factory()->create();
        $response = $this->get(route('anamnesis.show', ['id' => $Anamnesis->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'attendance_id'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateAnamnesis()
    {
        $this->withoutExceptionHandling();
        $Anamnesis = Anamnesis::factory()->create();
        $data = [
            'user_id' => User::factory()->create()->id,
            'doctor_id' => User::factory()->create()->id,
            'attendance_id' => Attendance::factory()->create()->id,
        ];
        $response = $this->put(route('anamnesis.update', ['id' => $Anamnesis->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'attendance_id'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteAnamnesis()
    {
        $this->withoutExceptionHandling();
        $Anamnesis = Anamnesis::factory()->create();
        $response = $this->delete(route('anamnesis.destroy', ['id' => $Anamnesis->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }
}
