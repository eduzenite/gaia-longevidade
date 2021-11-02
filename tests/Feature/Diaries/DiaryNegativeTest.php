<?php

namespace Tests\Feature\Diaries;

use App\Models\Diary;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class DiaryNegativeTest extends TestCase
{
    /**
     * @test
     */
    public function store_diary_with_wrong_fields()
    {
        $this->withoutExceptionHandling();
        $data = [
            'user_id' => 0,
            'appointment' => 'Y-m-d H:i',
            'description' => '',
        ];
        $this->post(route('diaries.store'), $data)
            ->assertStatus(400)
            ->assertJson(['error' => 'Bad Request']);
    }

    /**
     * @test
     */
    public function update_diary_with_wrong_fields()
    {
        $this->withoutExceptionHandling();
        $Diary = Diary::factory()->create();
        $data = [
            'appointment' => 'Y-m-d H:i',
            'description' => '',
        ];
        $this->put(route('diaries.update', ['id' => $Diary->id]), $data)
            ->assertStatus(400)
            ->assertJson(['error' => 'Bad Request']);
    }

    /**
     * @test
     */
    public function update_non_existent_diary()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $date = Carbon::today();
        if(rand(0,1)){
            $date->subDays(rand(0, 35));
        }else{
            $date->addDays(rand(0, 35));
        }
        $data = [
            'appointment' => $date->format('Y-m-d H:i'),
            'description' => $faker->sentence(150, true),
        ];
        $this->put(route('diaries.update', ['id' => 0]), $data)
            ->assertStatus(404)
            ->assertJson(['error' => 'Not Found']);
    }

    /**
     * @test
     */
    public function show_non_existent_diary()
    {
        $this->withoutExceptionHandling();
        $this->get(route('diaries.show', ['id' => 0]))
            ->assertStatus(404)
            ->assertJson(['error' => 'Not Found']);
    }

    /**
     * @test
     */
    public function delete_non_existent_diary()
    {
        $this->withoutExceptionHandling();
        $this->delete(route('diaries.destroy', ['id' =>0]))
            ->assertStatus(404)
            ->assertJson(['error' => 'Not Found']);
    }
}
