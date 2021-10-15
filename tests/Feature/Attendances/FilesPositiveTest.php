<?php

namespace Tests\Feature\Attendances;

use App\Models\Attendance;
use App\Models\AttendanceDetails;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilesPositiveTest extends TestCase
{
    /**
     * @test
     */
    public function store_attendance_details()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $Attendance = Attendance::inRandomOrder()->first();
        $data = [
            'attendance_id' => $Attendance->id,
            'file' => '',
            'category' => rand(1, 2),
        ];
        $this->post(route('attendances-files.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function update_attendance_details()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $AttendanceDetails = AttendanceDetails::inRandomOrder()->first();
        $data = [
            'title' => 'Diagnóstico',
            'contents' => $faker->sentence(500, true),
        ];
        $this->put(route('attendances-details.update', ['id' => $AttendanceDetails->id]), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function delete_attendance_details()
    {
        $this->withoutExceptionHandling();
        $AttendanceDetails = AttendanceDetails::inRandomOrder()->first();
        $this->delete(route('attendances-details.destroy', ['id' => $AttendanceDetails->id]))
            ->assertStatus(200);
    }
}
