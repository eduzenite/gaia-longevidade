<?php

namespace Tests\Feature\Files;

use App\Models\Attendance;
use App\Models\AttendanceDetails;
use App\Models\File;
use Faker\Factory as Faker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FilesPositiveTest extends TestCase
{
    /**
     * @test
     */
    public function store_attendance_file()
    {
        $this->withoutExceptionHandling();
        $Attendance = Attendance::inRandomOrder()->first();
        $faker = Faker::create();
        $folder = 'storage/app/public/test';
        if(!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }
        $filePath = $faker->image($folder, 1900, 1267, 'Medicine', true, false, '1');
        $data = [
            'attendance_id' => $Attendance->id,
            'file' => new UploadedFile($filePath,'diary-file.jpg', 'image/jpeg', null, true),
            'category' => rand(1, 2),
        ];
        $this->postJson(route('attendances-files.store'), $data)
            ->assertStatus(200);
//        unlink($filePath);
    }

    /**
     * @test
     */
    public function update_attendance_file()
    {
        $this->withoutExceptionHandling();
        $File = File::inRandomOrder()->first();
        $data = [
            'title' => 'Diagnóstico',
            'alt' => 'Esse é um novo alt',
        ];
        $this->put(route('attendances-files.update', ['id' => $File->id]), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function delete_attendance_file()
    {
        $this->withoutExceptionHandling();
        $File = File::inRandomOrder()->first();
        $this->delete(route('attendances-files.destroy', ['id' => $File->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }
}
