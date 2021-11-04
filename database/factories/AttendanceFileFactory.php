<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\File;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'attendance_id' => Attendance::factory(),
            'files_id' => File::factory(),
            'type' => rand(1, 2)
        ];
    }
}
