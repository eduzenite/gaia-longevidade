<?php

namespace Tests\Feature\Attendances;

use App\Models\Attendance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class AttendanceNegativeTest extends TestCase
{
    /**
     * @test
     */
    public function store_attendance_with_wrong_fields()
    {
        $this->withoutExceptionHandling();
        $data = [
            'appointment' => "25/08/1986 21:00",
            'time' => "H:i",
            'type' => 5,
            'amount' => '200,00'
        ];
        $this->post(route('attendances.store'), $data)
            ->assertStatus(400)
            ->assertJson(['error' => 'Bad Request']);
    }

    /**
     * @test
     */
    public function update_attendance_with_wrong_fields()
    {
        $this->withoutExceptionHandling();
        $Attendance = Attendance::inRandomOrder()->first();
        $data = [
            'appointment' => "25/08/1986 21:00",
            'time' => "H:i",
            'type' => 5,
            'amount' => '200,00'
        ];
        $this->put(route('attendances.update', ['id' => $Attendance->id]), $data)
            ->assertStatus(400)
            ->assertJson(['error' => 'Bad Request']);
    }

    /**
     * @test
     */
    public function update_non_existent_attendance()
    {
        $this->withoutExceptionHandling();
        $date = Carbon::today();
        if(rand(0,1)){
            $date->subDays(rand(0, 5));
        }else{
            $date->addDays(rand(0, 5));
        }
        $timeMinutes = ["30", "00"];
        $data = [
            'appointment' => $date->format('Y-m-d H:i'),
            'time' => rand(1, 2).':'.$timeMinutes[rand(0, 1)],
            'type' => rand(0, 2),
            'amount' => rand(150, 350).'.'.rand(10, 99)
        ];
        $this->put(route('attendances.update', ['id' => 0]), $data)
            ->assertStatus(404)
            ->assertJson(['error' => 'Not Found']);
    }

    /**
     * @test
     */
    public function show_non_existent_attendance()
    {
        $this->withoutExceptionHandling();
        $this->get(route('attendances.show', ['id' => 0]))
            ->assertStatus(404)
            ->assertJson(['error' => 'Not Found']);
    }

    /**
     * @test
     */
    public function delete_non_existent_attendance()
    {
        $this->withoutExceptionHandling();
        $this->delete(route('attendances.destroy', ['id' =>0]))
            ->assertStatus(404)
            ->assertJson(['error' => 'Not Found']);
    }
}
