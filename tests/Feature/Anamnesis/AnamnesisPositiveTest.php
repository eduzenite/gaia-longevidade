<?php

namespace Tests\Feature\Anamnesis;

use App\Models\anamnesis;
use App\Models\Attendance;
use App\Models\User;
use Tests\TestCase;

class AnamnesisPositiveTest extends TestCase
{
    /**
     * @test
     */
    public function list_anamnesis()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('anamnesis.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function store_anamnesis()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $doctor = User::factory()->create();
        $Attendance = Attendance::factory()->create();
        $data = [
            'user_id' => $user->id,
            'doctor_id' => $doctor->id,
            'attendance_id' => $Attendance->id,
        ];
        $this->post(route('anamnesis.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function update_anamnesis()
    {
        $anamnesis = Anamnesis::factory()->create();
        $this->withoutExceptionHandling();
        $doctor = User::factory()->create();
        $data = [
            'doctor_id' => $doctor->id,
        ];
        $this->put(route('anamnesis.update', ['id' => $anamnesis->id]), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function show_anamnesis()
    {
        $this->withoutExceptionHandling();
        $anamnesis = Anamnesis::factory()->create();
        $this->get(route('anamnesis.show', ['id' => $anamnesis->id]))
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function delete_anamnesis()
    {
        $this->withoutExceptionHandling();
        $anamnesis = Anamnesis::factory()->create();
        $this->delete(route('anamnesis.destroy', ['id' => $anamnesis->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }
}
