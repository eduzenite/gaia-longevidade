<?php

namespace Tests\Feature\Diaries;

use App\Models\Diary;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class DiaryPositiveTest extends TestCase
{
    /**
     * @test
     */
    public function list_diaries()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('diaries.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function store_diary()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $user = User::inRandomOrder()->where('role', 1)->first();
        $date = Carbon::today();
        if(rand(0,1)){
            $date->subDays(rand(0, 35));
        }else{
            $date->addDays(rand(0, 35));
        }
        $data = [
            'user_id' => $user->id,
            'appointment' => $date->format('Y-m-d H:i'),
            'description' => $faker->sentence(150, true),
        ];
        $this->post(route('diaries.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function update_diary()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $date = Carbon::today();
        if(rand(0,1)){
            $date->subDays(rand(0, 5));
        }else{
            $date->addDays(rand(0, 5));
        }
        $Attendance = Diary::inRandomOrder()->first();
        $data = [
            'appointment' => $date->format('Y-m-d H:i'),
            'description' => $faker->sentence(150, true),
        ];
        $this->put(route('diaries.update', ['id' => $Attendance->id]), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function show_diary()
    {
        $this->withoutExceptionHandling();
        $Diary = Diary::inRandomOrder()->first();
        $this->get(route('diaries.show', ['id' => $Diary->id]))
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function delete_diary()
    {
        $this->withoutExceptionHandling();
        $Diary = Diary::inRandomOrder()->first();
        $this->delete(route('diaries.destroy', ['id' => $Diary->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }
}
