<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AttendanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attendance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = Carbon::now();
        if(rand(0,1)){
            $date->subDays(rand(0, 5));
        }else{
            $date->addDays(rand(0, 5));
        }
        $timeMinutes = ["30", "00"];
        return [
            'user_id' => User::factory(),
            'doctor_id' => User::factory(),
            'status' => rand(1, 4),
            'appointment' => $date->format('Y-m-d H:i'),
            'time' => rand(1, 2).':'.$timeMinutes[rand(0, 1)],
            'type' => rand(1, 3),
            'speciality_id' => Speciality::factory(),
            'amount' => rand(150, 350).'.'.rand(10, 99),
            'event_id' => rand(100, 999)
        ];
    }
}
