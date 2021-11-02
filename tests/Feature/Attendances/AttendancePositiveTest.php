<?php

namespace Tests\Feature\Attendances;

use App\Models\Attendance;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class AttendancePositiveTest extends TestCase
{
    /**
     * @test
     */
    public function list_attendances()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('attendances.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function store_attendance()
    {
        $this->withoutExceptionHandling();
        $date = Carbon::today();
        if(rand(0,1)){
            $date->subDays(rand(0, 5));
        }else{
            $date->addDays(rand(0, 5));
        }
        $timeMinutes = ["30", "00"];
        $user = User::factory()->create();
        $doctor = User::factory()->create();
        $speciality = Speciality::factory()->create();
        $data = [
            'user_id' => $user->id,
            'doctor_id' => $doctor->id,
            'appointment' => $date->format('Y-m-d H:i'),
            'time' => rand(1, 2).':'.$timeMinutes[rand(0, 1)],
            'type' => rand(0, 2),
            'speciality_id' => $speciality->id,
            'amount' => rand(150, 350).'.'.rand(10, 99)
        ];
        $this->post(route('attendances.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function update_attendance()
    {
        $this->withoutExceptionHandling();
        $date = Carbon::today();
        if(rand(0,1)){
            $date->subDays(rand(0, 5));
        }else{
            $date->addDays(rand(0, 5));
        }
        $Attendance = Attendance::factory()->create();
        $timeMinutes = ["30", "00"];
        $data = [
            'appointment' => $date->format('Y-m-d H:i'),
            'time' => rand(1, 2).':'.$timeMinutes[rand(0, 1)],
            'type' => rand(0, 2),
            'amount' => rand(150, 350).'.'.rand(10, 99)
        ];
        $this->put(route('attendances.update', ['id' => $Attendance->id]), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function show_attendance()
    {
        $this->withoutExceptionHandling();
        $Attendance = Attendance::factory()->create();
        $this->get(route('attendances.show', ['id' => $Attendance->id]))
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function delete_attendance()
    {
        $this->withoutExceptionHandling();
        $Attendance = Attendance::factory()->create();
        $this->delete(route('attendances.destroy', ['id' => $Attendance->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }
}
