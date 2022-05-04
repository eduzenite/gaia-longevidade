<?php

namespace Tests\Feature\Attendance\Positive;

use App\Models\Attendance;
use App\Models\AttendanceFile;
use App\Models\File;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AttendanceFileTest extends TestCase
{
    /**
     * @test
     */
    public function testListAttendanceFile()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $Attendance = Attendance::factory()->create();
        $response = $this->get(route('attendancefiles.index', ['attendanceId' => $Attendance->id]));
        $response->assertStatus(200);
        $fields = ['message', 'status', 'current_page', 'data', 'to', 'total', 'first_page_url', 'from', 'last_page', 'last_page_url', 'links', 'next_page_url', 'path', 'per_page', 'prev_page_url'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateAttendanceFile()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $data = [
            'user_id' => User::factory()->create()->id,
            'attendance_id' => Attendance::factory()->create()->id,
            'files_id' => File::factory()->create()->id,
            'type' => rand(1, 2),
        ];
        $Attendance = Attendance::factory()->create();
        $response = $this->post(route('attendancefiles.store', ['attendanceId' => $Attendance->id]), $data);
        $response->assertStatus(201);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'user_id', 'attendance_id', 'files_id', 'type'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsAttendanceFile()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $AttendanceFile = AttendanceFile::factory()->create();
        $response = $this->get(route('attendancefiles.show', ['attendanceId' => $AttendanceFile->attendance_id, 'attendanceFileId' => $AttendanceFile->id]));
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'user_id', 'attendance_id', 'files_id', 'type'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteAttendanceFile()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->withoutExceptionHandling();
        $AttendanceFile = AttendanceFile::factory()->create();
        $response = $this->delete(route('attendancefiles.destroy', ['attendanceId' => $AttendanceFile->attendance_id, 'attendanceFileId' => $AttendanceFile->id]));
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Deleted']);
    }
}
