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
        $response = $this->get(route('attendancedetails.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
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
        $response = $this->post(route('attendancedetails.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'title', 'contents'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsAttendanceDetails()
    {
        $this->withoutExceptionHandling();
        $AttendanceDetails = AttendanceDetails::factory()->create();
        $response = $this->get(route('attendancedetails.show', ['id' => $AttendanceDetails->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'title', 'contents'];
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
            'title' => $faker->sentence(5, true),
            'contents' => $faker->sentence(500, true),
        ];
        $response = $this->put(route('attendancedetails.update', ['id' => $AttendanceDetails->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'title', 'contents'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteAttendanceDetails()
    {
        $this->withoutExceptionHandling();
        $AttendanceDetails = AttendanceDetails::factory()->create();
        $response = $this->delete(route('attendancedetails.destroy', ['id' => $AttendanceDetails->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }
}
