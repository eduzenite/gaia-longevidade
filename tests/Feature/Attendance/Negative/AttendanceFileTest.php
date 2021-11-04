<?php

namespace Tests\Feature\Attendance\Negative;

use App\Models\Attendance;
use App\Models\AttendanceFile;
use App\Models\File;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AttendanceFileTest extends TestCase
{
    /**
     * @test
     */
    public function store_attendance_file()
    {
        $this->withoutExceptionHandling();
        $User = User::factory()->create();
        $Attendance = Attendance::factory()->create();
        $File = File::factory()->create();
        $data = [
            'user_id' => $User->id,
            'attendance_id' => $Attendance->id,
            'files_id' => $File->id,
            'type' => rand(1, 2)
        ];

        $this->postJson(route('attendancefiles.store'), $data)
            ->assertStatus(200);
        unlink($File->path);
        unlink($File->large->path);
        unlink($File->medium->path);
        unlink($File->thumbnail->path);
    }

    /**
     * @test
     */
    public function delete_attendance_file()
    {
        $this->withoutExceptionHandling();
        $File = AttendanceFile::factory()->create();
        $this->delete(route('attendancefiles.destroy', ['id' => $File->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }
}
