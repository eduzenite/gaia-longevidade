<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $filePath = 'storage/app/public/attendance/test/';
        $images = [
            'alt' => $this->faker->sentence(10, true),
            'path' => $this->faker->image($filePath,1900,1267),
            'width' => 1900,
            'height' => 1267,
            'large' => [
                'path' => $this->faker->image($filePath,1024,768),
                'width' => 1024,
                'height' => 768
            ],
            'medium' => [
                'path' => $this->faker->image($filePath,800,534),
                'width' => 800,
                'height' => 534
            ],
            'thumbnail' => [
                'path' => $this->faker->image($filePath,500,333),
                'width' => 500,
                'height' => 333
            ],
        ];
        return [
            'title' => $this->faker->sentence(6, true),
            'type' => $this->faker->mimeType,
            'info' => json_encode($images)
        ];
    }
}
