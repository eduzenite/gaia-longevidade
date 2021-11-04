<?php

namespace Tests\Feature\Attendance\Positive;

use App\Models\Attendance;
use App\Models\AttendanceFile;
use App\Models\File;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AttendanceFileTest extends TestCase
{
    /**
     * @test
     */
    public function testListAttendanceFile()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('attendancefile.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateAttendanceFile()
    {
        $this->withoutExceptionHandling();
        $data = [
            'user_id' => User::factory()->create()->id,
            'attendance_id' => Attendance::factory()->create()->id,
            'files_id' => File::factory()->create()->id,
            'type' => rand(1, 2),
        ];
        $response = $this->post(route('attendancefile.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'attendance_id', 'files_id', 'type'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsAttendanceFile()
    {
        $this->withoutExceptionHandling();
        $AttendanceFile = AttendanceFile::factory()->create();
        $response = $this->get(route('attendancefile.show', ['id' => $AttendanceFile->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'attendance_id', 'files_id', 'type'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteAttendanceFile()
    {
        $this->withoutExceptionHandling();
        $AttendanceFile = AttendanceFile::factory()->create();
        $response = $this->delete(route('attendancefile.destroy', ['id' => $AttendanceFile->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }

}
