<?php

namespace Tests\Feature\Attendances;

use App\Models\Attendance;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class AttendanceDetailsNegativeTest extends TestCase
{
    /**
     * @test
     */
    public function store_attendance_details_with_wrong_fields()
    {
        $this->withoutExceptionHandling();
        $Attendance = Attendance::inRandomOrder()->first();
        $data = [
            'attendance_id' => $Attendance->id,
            'title' => 1,
            'contents' => "",
        ];
        $this->post(route('attendances-details.store'), $data)
            ->assertStatus(400)
            ->assertJson(['error' => 'Bad Request']);
    }

    /**
     * @test
     */
    public function update_attendance_details_with_wrong_fields()
    {
        $this->withoutExceptionHandling();
        $Attendance = Attendance::inRandomOrder()->first();
        $data = [
            'title' => 1,
            'contents' => "",
        ];
        $this->put(route('attendances-details.update', ['id' => $Attendance->id]), $data)
            ->assertStatus(400)
            ->assertJson(['error' => 'Bad Request']);
    }

    /**
     * @test
     */
    public function update_non_existent_attendance_details()
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
        $this->put(route('attendances-details.update', ['id' => 0]), $data)
            ->assertStatus(404)
            ->assertJson(['error' => 'Not Found']);
    }

    /**
     * @test
     */
    public function delete_non_existent_attendance_details()
    {
        $this->withoutExceptionHandling();
        $this->delete(route('attendances-details.destroy', ['id' =>0]))
            ->assertStatus(404)
            ->assertJson(['error' => 'Not Found']);
    }
}
