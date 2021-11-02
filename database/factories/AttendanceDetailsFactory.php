<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\AttendanceDetails;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AttendanceDetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AttendanceDetails::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'attendance_id' => Attendance::factory(),
            'title' => $this->faker->sentence(5, true),
            'contents' => $this->faker->sentence(500, true),
        ];
    }
}
