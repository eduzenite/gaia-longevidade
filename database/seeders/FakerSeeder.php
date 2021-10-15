<?php

namespace Database\Seeders;

use App\Models\ActiveIngredient;
use App\Models\Address;
use App\Models\Attachment;
use App\Models\AttachmentMeta;
use App\Models\Attendance;
use App\Models\AttendanceDetails;
use App\Models\Category;
use App\Models\File;
use App\Models\Manufacturer;
use App\Models\Medicine;
use App\Models\MedicineDescription;
use App\Models\MedicineMeta;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * To run: php artisan db:seed --class=FakerSeeder
     *
     * @return void
     */
    public function run()
    {
        User::factory(50)->create();
        Attendance::factory(10)->create()->each(function ($attendance) {
            $faker = Faker::create();
            foreach (['Hipótese', 'Diagnóstico', 'Tratamento', 'Observações'] as $item){
                $Address = new AttendanceDetails();
                $Address->attendance_id = $attendance->id;
                $Address->title = $item;
                $Address->contents = $faker->sentence(500, true);
                $Address->save();
            }

            $folder = 'storage/app/public/attendance/'.$attendance->id;
            if(!is_dir($folder)) {
                mkdir($folder, 0755, true);
            }
            foreach(range(0, 5) as $item) {
                $images = [
                    'alt' => $faker->sentence(10, true),
                    'path' => $faker->image($folder, 1900, 1267, 'Medicine', true, false, $attendance->id),
                    'width' => 1900,
                    'height' => 1267,
                    'large' => [
                        'file' => $faker->image($folder, 1024, 768, 'Medicine', true, false, $attendance->id),
                        'width' => 1024,
                        'height' => 768
                    ],
                    'medium' => [
                        'file' => $faker->image($folder, 800, 534, 'Medicine', true, false, $attendance->id),
                        'width' => 800,
                        'height' => 534
                    ],
                    'thumbnail' => [
                        'file' => $faker->image($folder, 500, 333, 'Medicine', true, false, $attendance->id),
                        'width' => 500,
                        'height' => 333
                    ],
                ];
                $File = new File();
                $File->title = $faker->sentence(6, true);
                $File->type = $faker->mimeType;
                $File->info = json_encode($images);
                $File->save();
                $File->attendance()->syncWithPivotValues($attendance, ['category' => rand(1, 2)]);
            }
        });
    }
}
