<?php

namespace Tests\Feature\Attendance\Positive;

use App\Models\Attendance;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AttendanceTest extends TestCase
{
    /**
     * @test
     */
    public function testListAttendance()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('attendance.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateAttendance()
    {
        $this->withoutExceptionHandling();
        $date = Carbon::now();
        if(rand(0,1)){
            $date->subDays(rand(0, 5));
        }else{
            $date->addDays(rand(0, 5));
        }
        $timeMinutes = ["30", "00"];
        $data = [
            'user_id' => User::factory()->create()->id,
            'doctor_id' => User::factory()->create()->id,
            'status' => rand(1, 4),
            'appointment' => $date->format('Y-m-d H:i'),
            'time' => rand(1, 2).':'.$timeMinutes[rand(0, 1)],
            'type' => rand(1, 3),
            'speciality_id' => Speciality::factory(),
            'amount' => rand(150, 350).'.'.rand(10, 99),
            'event_id' => rand(100, 999)
        ];
        $response = $this->post(route('attendance.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'status', 'appointment', 'time', 'type', 'speciality_id', 'amount', 'url'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsAttendance()
    {
        $this->withoutExceptionHandling();
        $Attendance = Attendance::factory()->create();
        $response = $this->get(route('attendance.show', ['id' => $Attendance->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'status', 'appointment', 'time', 'type', 'speciality_id', 'amount', 'url'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateAttendance()
    {
        $this->withoutExceptionHandling();
        $Attendance = Attendance::factory()->create();
        $date = Carbon::now();
        if(rand(0,1)){
            $date->subDays(rand(0, 5));
        }else{
            $date->addDays(rand(0, 5));
        }
        $timeMinutes = ["30", "00"];
        $data = [
            'status' => rand(1, 4),
            'appointment' => $date->format('Y-m-d H:i'),
            'time' => rand(1, 2).':'.$timeMinutes[rand(0, 1)],
            'type' => rand(1, 3),
            'amount' => rand(150, 350).'.'.rand(10, 99),
        ];
        $response = $this->put(route('attendance.update', ['id' => $Attendance->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'status', 'appointment', 'time', 'type', 'speciality_id', 'amount', 'url'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteAttendance()
    {
        $this->withoutExceptionHandling();
        $Attendance = Attendance::factory()->create();
        $response = $this->delete(route('attendance.destroy', ['id' => $Attendance->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }

}
