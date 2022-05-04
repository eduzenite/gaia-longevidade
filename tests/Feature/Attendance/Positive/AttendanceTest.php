<?php

namespace Tests\Feature\Attendance\Positive;

use App\Models\Attendance;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AttendanceTest extends TestCase
{
    /**
     * @test
     */
    public function testListAttendance()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $response = $this->get(route('attendances.index'));
        $response->assertStatus(200);
        $fields = ['message', 'status', 'current_page', 'data', 'to', 'total', 'first_page_url', 'from', 'last_page', 'last_page_url', 'links', 'next_page_url', 'path', 'per_page', 'prev_page_url'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateAttendance()
    {
        Sanctum::actingAs(User::factory()->create());
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
            'status' => 3,
            'appointment' => $date->format("Y-m-d H:i"),
            'time' => rand(1, 2).":".$timeMinutes[rand(0, 1)],
            'type' => rand(1, 3),
            'speciality_id' => Speciality::factory()->create()->id,
            'amount' => rand(150, 350).".".rand(10, 99),
            'event_id' => rand(10000000, 99999999),
        ];
        $response = $this->post(route('attendances.store'), $data);
        $response->assertStatus(201);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'status', 'appointment', 'time', 'type', 'speciality_id', 'amount', 'event_id'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsAttendance()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Attendance = Attendance::factory()->create();
        $response = $this->get(route('attendances.show', ['attendanceId' => $Attendance->id]));
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'user_id', 'doctor_id', 'status', 'appointment', 'time', 'type', 'speciality_id', 'amount', 'event_id'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateAttendance()
    {
        Sanctum::actingAs(User::factory()->create());
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
            'user_id' => User::factory()->create()->id,
            'doctor_id' => User::factory()->create()->id,
            'status' => 3,
            'appointment' => $date->format("Y-m-d H:i"),
            'time' => rand(1, 2).":".$timeMinutes[rand(0, 1)],
            'type' => rand(1, 3),
            'speciality_id' => Speciality::factory()->create()->id,
            'amount' => rand(150, 350).".".rand(10, 99),
            'event_id' => rand(10000000, 99999999),
        ];
        $response = $this->put(route('attendances.update', ['attendanceId' => $Attendance->id]), $data);
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'updated', 'user_id', 'doctor_id', 'status', 'appointment', 'time', 'type', 'speciality_id', 'amount', 'event_id'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteAttendance()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Attendance = Attendance::factory()->create();
        $response = $this->delete(route('attendances.destroy', ['attendanceId' => $Attendance->id]));
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Deleted']);
    }
}
