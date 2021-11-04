<?php

namespace Tests\Feature\User\Positive;

use App\Models\Speciality;
use App\Models\User;
use App\Models\UserSpecialty;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserSpecialtyTest extends TestCase
{
    /**
     * @test
     */
    public function testListUserSpecialty()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('userspecialty.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreateUserSpecialty()
    {
        $this->withoutExceptionHandling();
        $data = [
            'user_id' => User::factory()->create()->id,
            'specialty_id' => Speciality::factory()->create()->id
        ];
        $response = $this->post(route('userspecialty.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'specialty_id'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetailsUserSpecialty()
    {
        $this->withoutExceptionHandling();
        $UserSpecialty = UserSpecialty::factory()->create();
        $response = $this->get(route('userspecialty.show', ['id' => $UserSpecialty->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'specialty_id'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdateUserSpecialty()
    {
        $this->withoutExceptionHandling();
        $UserSpecialty = UserSpecialty::factory()->create();
        $data = [
            'specialty_id' => Speciality::factory()->create()->id
        ];
        $response = $this->put(route('userspecialty.update', ['id' => $UserSpecialty->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at', 'user_id', 'specialty_id'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDeleteUserSpecialty()
    {
        $this->withoutExceptionHandling();
        $UserSpecialty = UserSpecialty::factory()->create();
        $response = $this->delete(route('userspecialty.destroy', ['id' => $UserSpecialty->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }
}
