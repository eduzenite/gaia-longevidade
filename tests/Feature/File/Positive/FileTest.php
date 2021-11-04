<?php

namespace Tests\Feature\File\Positive;

use App\Models\File;
use Faker\Factory as Faker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class FileTest extends TestCase
{
    /**
     * @test
     */
    public function testListFile()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('file.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateFile()
    {
        $this->withoutExceptionHandling();
        $faker = Faker::create();
        $filePath = 'storage/app/public/test/';
        $data = [
            'file' => $faker->image($filePath,1900,1267),
        ];
        $response = $this->post(route('file.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'title', 'type', 'info'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsFile()
    {
        $this->withoutExceptionHandling();
        $File = File::factory()->create();
        $response = $this->get(route('file.show', ['id' => $File->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'title', 'type', 'info'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateFile()
    {
        $this->withoutExceptionHandling();
        $File = File::factory()->create();
        $faker = Faker::create();
        $data = [
            'title' => $faker,
            'alt' => $faker,
        ];
        $response = $this->put(route('file.update', ['id' => $File->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'title', 'type', 'info'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteFile()
    {
        $this->withoutExceptionHandling();
        $File = File::factory()->create();
        $response = $this->delete(route('file.destroy', ['id' => $File->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }
}
