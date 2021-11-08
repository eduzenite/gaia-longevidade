<?php

namespace Tests\Feature\Attendance\Positive;

use App\Models\Attendance;
use App\Models\AttendanceDetails;
use Faker\Factory as Faker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AttendanceDetailsTest extends TestCase
{
    /**
     * @test
     */
    public function testListAttendanceDetails()
    {
        $this->withoutExceptionHandling();
        $Attendance = Attendance::factory()->create();
        $response = $this->get(route('attendancedetails.index', ['attendanceId' => $Attendance->id]));
        $response->assertStatus(200);
        $fields = ['message', 'status', 'current_page', 'data', 'to', 'total', 'first_page_url', 'from', 'last_page', 'last_page_url', 'links', 'next_page_url', 'path', 'per_page', 'prev_page_url'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateAttendanceDetails()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $data = [
            'attendance_id' => Attendance::factory()->create()->id,
            'title' => $faker->sentence(5, true),
            'contents' => $faker->sentence(500, true),
        ];
        $Attendance = Attendance::factory()->create();
        $response = $this->post(route('attendancedetails.store', ['attendanceId' => $Attendance->id]), $data);
        $response->assertStatus(201);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'attendance_id', 'title', 'contents'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsAttendanceDetails()
    {
        $this->withoutExceptionHandling();
        $AttendanceDetails = AttendanceDetails::factory()->create();
        $response = $this->get(route('attendancedetails.show', ['attendanceId' => $AttendanceDetails->attendance_id, 'attendanceDetailId' => $AttendanceDetails->id]));
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'attendance_id', 'title', 'contents'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateAttendanceDetails()
    {
        $this->withoutExceptionHandling();
        $AttendanceDetails = AttendanceDetails::factory()->create();
        $faker = Faker::create();
        $data = [
            'attendance_id' => Attendance::factory()->create()->id,
            'title' => $faker->sentence(5, true),
            'contents' => $faker->sentence(500, true),
        ];
        $response = $this->put(route('attendancedetails.update', ['attendanceId' => $AttendanceDetails->attendance_id, 'attendanceDetailId' => $AttendanceDetails->id]), $data);
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'updated', 'attendance_id', 'title', 'contents'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteAttendanceDetails()
    {
        $this->withoutExceptionHandling();
        $AttendanceDetails = AttendanceDetails::factory()->create();
        $response = $this->delete(route('attendancedetails.destroy', ['attendanceId' => $AttendanceDetails->attendance_id, 'attendanceDetailId' => $AttendanceDetails->id]));
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Deleted']);
    }
}
