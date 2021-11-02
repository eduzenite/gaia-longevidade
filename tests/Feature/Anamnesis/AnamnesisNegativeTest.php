<?php

namespace Tests\Feature\Anamnesis;

use App\Models\Anamnesis;
use App\Models\Diary;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class AnamnesisNegativeTest extends TestCase
{
    /**
     * @test
     */
    public function store_diary_with_wrong_fields()
    {
        $this->withoutExceptionHandling();
        $data = [
            'user_id' => 'x',
            'doctor_id' => 'x',
            'attendance_id' => 'x',
        ];
        $this->post(route('anamnesis.store'), $data)
            ->assertStatus(400)
            ->assertJson(['error' => 'Bad Request']);
    }

    /**
     * @test
     */
    public function update_diary_with_wrong_fields()
    {
        $this->withoutExceptionHandling();
        $Anamnesis = Anamnesis::factory()->create();
        $data = [
            'doctor_id' => 'x',
        ];
        $this->put(route('anamnesis.update', ['id' => $Anamnesis->id]), $data)
            ->assertStatus(400)
            ->assertJson(['error' => 'Bad Request']);
    }

    /**
     * @test
     */
    public function update_non_existent_diary()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $data = [
            'doctor_id' => $user->id,
        ];
        $this->put(route('anamnesis.update', ['id' => 0]), $data)
            ->assertStatus(404)
            ->assertJson(['error' => 'Not Found']);
    }

    /**
     * @test
     */
    public function show_non_existent_diary()
    {
        $this->withoutExceptionHandling();
        $this->get(route('anamnesis.show', ['id' => 0]))
            ->assertStatus(404)
            ->assertJson(['error' => 'Not Found']);
    }

    /**
     * @test
     */
    public function delete_non_existent_diary()
    {
        $this->withoutExceptionHandling();
        $this->delete(route('anamnesis.destroy', ['id' =>0]))
            ->assertStatus(404)
            ->assertJson(['error' => 'Not Found']);
    }
}
