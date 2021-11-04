<?php

namespace Tests\Feature\Attendance\Negative;

use App\Models\Attendance;
use App\Models\AttendanceDetails;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class AttendanceDetailsTest extends TestCase
{
    /**
     * @test
     */
    public function store_attendance_details_with_wrong_fields()
    {
        $this->withoutExceptionHandling();
        $Attendance = Attendance::factory()->create();
        $data = [
            'attendance_id' => $Attendance->id,
            'title' => 1,
            'contents' => "",
        ];
        $this->post(route('attendancedetails.store'), $data)
            ->assertStatus(400)
            ->assertJson(['error' => 'Bad Request']);
    }

    /**
     * @test
     */
    public function update_attendance_details_with_wrong_fields()
    {
        $this->withoutExceptionHandling();
        $Attendance = AttendanceDetails::factory()->create();
        $data = [
            'title' => 1,
            'contents' => "",
        ];
        $this->put(route('attendancedetails.update', ['id' => $Attendance->id]), $data)
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
        $this->put(route('attendancedetails.update', ['id' => 0]), $data)
            ->assertStatus(404)
            ->assertJson(['error' => 'Not Found']);
    }

    /**
     * @test
     */
    public function delete_non_existent_attendance_details()
    {
        $this->withoutExceptionHandling();
        $this->delete(route('attendancedetails.destroy', ['id' =>0]))
            ->assertStatus(404)
            ->assertJson(['error' => 'Not Found']);
    }
}
