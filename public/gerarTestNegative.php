<?php

class AnamnesisTest
{
    /**
     * @test
     */
    public function testListAnamnesisAnswers(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('xxx.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreateAnamnesisAnswers(){
        $this->withoutExceptionHandling();
        $data = [
            'xxx' => 'xxx',
        ];
        $this->post(route('xxx.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function testShowDetailsAnamnesisAnswers(){
        $this->withoutExceptionHandling();
        $xxx = Xxxx::factory()->create();
        $this->get(route('xxx.show', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testUpdateAnamnesisAnswers(){
        $this->withoutExceptionHandling();
        $xxx = xxx::factory()->create();
        $data = [
            'xxx' => 'xxx',
        ];
        $xxx->xxx = 'xxx';
        $this->put(route('xxx.update', ['id' => $xxx->id]), $data)
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testDeleteAnamnesisAnswers(){
        $this->withoutExceptionHandling();
        $xxx = Xxx::factory()->create();
        $this->delete(route('xxx.destroy', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }






    /**
     * @test
     */
    public function testListAnamnesisMeta(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('xxx.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreateAnamnesisMeta(){
        $this->withoutExceptionHandling();
        $data = [
            'xxx' => 'xxx',
        ];
        $this->post(route('xxx.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function testShowDetailsAnamnesisMeta(){
        $this->withoutExceptionHandling();
        $xxx = Xxxx::factory()->create();
        $this->get(route('xxx.show', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testUpdateAnamnesisMeta(){
        $this->withoutExceptionHandling();
        $xxx = xxx::factory()->create();
        $data = [
            'xxx' => 'xxx',
        ];
        $xxx->xxx = 'xxx';
        $this->put(route('xxx.update', ['id' => $xxx->id]), $data)
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testDeleteAnamnesisMeta(){
        $this->withoutExceptionHandling();
        $xxx = Xxx::factory()->create();
        $this->delete(route('xxx.destroy', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }






    /**
     * @test
     */
    public function testListAnamnesisQuestions(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('xxx.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreateAnamnesisQuestions(){
        $this->withoutExceptionHandling();
        $data = [
            'xxx' => 'xxx',
        ];
        $this->post(route('xxx.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function testShowDetailsAnamnesisQuestions(){
        $this->withoutExceptionHandling();
        $xxx = Xxxx::factory()->create();
        $this->get(route('xxx.show', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testUpdateAnamnesisQuestions(){
        $this->withoutExceptionHandling();
        $xxx = xxx::factory()->create();
        $data = [
            'xxx' => 'xxx',
        ];
        $xxx->xxx = 'xxx';
        $this->put(route('xxx.update', ['id' => $xxx->id]), $data)
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testDeleteAnamnesisQuestions(){
        $this->withoutExceptionHandling();
        $xxx = Xxx::factory()->create();
        $this->delete(route('xxx.destroy', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }






    /**
     * @test
     */
    public function testListAttendance(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('xxx.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreateAttendance(){
        $this->withoutExceptionHandling();
        $data = [
            'xxx' => 'xxx',
        ];
        $this->post(route('xxx.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function testShowDetailsAttendance(){
        $this->withoutExceptionHandling();
        $xxx = Xxxx::factory()->create();
        $this->get(route('xxx.show', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testUpdateAttendance(){
        $this->withoutExceptionHandling();
        $xxx = xxx::factory()->create();
        $data = [
            'xxx' => 'xxx',
        ];
        $xxx->xxx = 'xxx';
        $this->put(route('xxx.update', ['id' => $xxx->id]), $data)
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testDeleteAttendance(){
        $this->withoutExceptionHandling();
        $xxx = Xxx::factory()->create();
        $this->delete(route('xxx.destroy', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }






    /**
     * @test
     */
    public function testListAttendanceDetails(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('xxx.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreateAttendanceDetails(){
        $this->withoutExceptionHandling();
        $data = [
            'xxx' => 'xxx',
        ];
        $this->post(route('xxx.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function testShowDetailsAttendanceDetails(){
        $this->withoutExceptionHandling();
        $xxx = Xxxx::factory()->create();
        $this->get(route('xxx.show', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testUpdateAttendanceDetails(){
        $this->withoutExceptionHandling();
        $xxx = xxx::factory()->create();
        $data = [
            'xxx' => 'xxx',
        ];
        $xxx->xxx = 'xxx';
        $this->put(route('xxx.update', ['id' => $xxx->id]), $data)
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testDeleteAttendanceDetails(){
        $this->withoutExceptionHandling();
        $xxx = Xxx::factory()->create();
        $this->delete(route('xxx.destroy', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }






    /**
     * @test
     */
    public function testListAttendanceFile(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('xxx.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreateAttendanceFile(){
        $this->withoutExceptionHandling();
        $data = [
            'xxx' => 'xxx',
        ];
        $this->post(route('xxx.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function testShowDetailsAttendanceFile(){
        $this->withoutExceptionHandling();
        $xxx = Xxxx::factory()->create();
        $this->get(route('xxx.show', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testUpdateAttendanceFile(){
        $this->withoutExceptionHandling();
        $xxx = xxx::factory()->create();
        $data = [
            'xxx' => 'xxx',
        ];
        $xxx->xxx = 'xxx';
        $this->put(route('xxx.update', ['id' => $xxx->id]), $data)
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testDeleteAttendanceFile(){
        $this->withoutExceptionHandling();
        $xxx = Xxx::factory()->create();
        $this->delete(route('xxx.destroy', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }






    /**
     * @test
     */
    public function testListDiary(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('xxx.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreateDiary(){
        $this->withoutExceptionHandling();
        $data = [
            'xxx' => 'xxx',
        ];
        $this->post(route('xxx.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function testShowDetailsDiary(){
        $this->withoutExceptionHandling();
        $xxx = Xxxx::factory()->create();
        $this->get(route('xxx.show', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testUpdateDiary(){
        $this->withoutExceptionHandling();
        $xxx = xxx::factory()->create();
        $data = [
            'xxx' => 'xxx',
        ];
        $xxx->xxx = 'xxx';
        $this->put(route('xxx.update', ['id' => $xxx->id]), $data)
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testDeleteDiary(){
        $this->withoutExceptionHandling();
        $xxx = Xxx::factory()->create();
        $this->delete(route('xxx.destroy', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }






    /**
     * @test
     */
    public function testListDiaryMeta(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('xxx.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreateDiaryMeta(){
        $this->withoutExceptionHandling();
        $data = [
            'xxx' => 'xxx',
        ];
        $this->post(route('xxx.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function testShowDetailsDiaryMeta(){
        $this->withoutExceptionHandling();
        $xxx = Xxxx::factory()->create();
        $this->get(route('xxx.show', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testUpdateDiaryMeta(){
        $this->withoutExceptionHandling();
        $xxx = xxx::factory()->create();
        $data = [
            'xxx' => 'xxx',
        ];
        $xxx->xxx = 'xxx';
        $this->put(route('xxx.update', ['id' => $xxx->id]), $data)
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testDeleteDiaryMeta(){
        $this->withoutExceptionHandling();
        $xxx = Xxx::factory()->create();
        $this->delete(route('xxx.destroy', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }






    /**
     * @test
     */
    public function testListFile(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('xxx.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreateFile(){
        $this->withoutExceptionHandling();
        $data = [
            'xxx' => 'xxx',
        ];
        $this->post(route('xxx.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function testShowDetailsFile(){
        $this->withoutExceptionHandling();
        $xxx = Xxxx::factory()->create();
        $this->get(route('xxx.show', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testUpdateFile(){
        $this->withoutExceptionHandling();
        $xxx = xxx::factory()->create();
        $data = [
            'xxx' => 'xxx',
        ];
        $xxx->xxx = 'xxx';
        $this->put(route('xxx.update', ['id' => $xxx->id]), $data)
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testDeleteFile(){
        $this->withoutExceptionHandling();
        $xxx = Xxx::factory()->create();
        $this->delete(route('xxx.destroy', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }






    /**
     * @test
     */
    public function testListMedicine(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('xxx.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreateMedicine(){
        $this->withoutExceptionHandling();
        $data = [
            'xxx' => 'xxx',
        ];
        $this->post(route('xxx.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function testShowDetailsMedicine(){
        $this->withoutExceptionHandling();
        $xxx = Xxxx::factory()->create();
        $this->get(route('xxx.show', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testUpdateMedicine(){
        $this->withoutExceptionHandling();
        $xxx = xxx::factory()->create();
        $data = [
            'xxx' => 'xxx',
        ];
        $xxx->xxx = 'xxx';
        $this->put(route('xxx.update', ['id' => $xxx->id]), $data)
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testDeleteMedicine(){
        $this->withoutExceptionHandling();
        $xxx = Xxx::factory()->create();
        $this->delete(route('xxx.destroy', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }






    /**
     * @test
     */
    public function testListMenu(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('xxx.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreateMenu(){
        $this->withoutExceptionHandling();
        $data = [
            'xxx' => 'xxx',
        ];
        $this->post(route('xxx.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function testShowDetailsMenu(){
        $this->withoutExceptionHandling();
        $xxx = Xxxx::factory()->create();
        $this->get(route('xxx.show', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testUpdateMenu(){
        $this->withoutExceptionHandling();
        $xxx = xxx::factory()->create();
        $data = [
            'xxx' => 'xxx',
        ];
        $xxx->xxx = 'xxx';
        $this->put(route('xxx.update', ['id' => $xxx->id]), $data)
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testDeleteMenu(){
        $this->withoutExceptionHandling();
        $xxx = Xxx::factory()->create();
        $this->delete(route('xxx.destroy', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }






    /**
     * @test
     */
    public function testListMenuFood(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('xxx.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreateMenuFood(){
        $this->withoutExceptionHandling();
        $data = [
            'xxx' => 'xxx',
        ];
        $this->post(route('xxx.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function testShowDetailsMenuFood(){
        $this->withoutExceptionHandling();
        $xxx = Xxxx::factory()->create();
        $this->get(route('xxx.show', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testUpdateMenuFood(){
        $this->withoutExceptionHandling();
        $xxx = xxx::factory()->create();
        $data = [
            'xxx' => 'xxx',
        ];
        $xxx->xxx = 'xxx';
        $this->put(route('xxx.update', ['id' => $xxx->id]), $data)
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testDeleteMenuFood(){
        $this->withoutExceptionHandling();
        $xxx = Xxx::factory()->create();
        $this->delete(route('xxx.destroy', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }






    /**
     * @test
     */
    public function testListPrescription(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('xxx.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreatePrescription(){
        $this->withoutExceptionHandling();
        $data = [
            'xxx' => 'xxx',
        ];
        $this->post(route('xxx.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function testShowDetailsPrescription(){
        $this->withoutExceptionHandling();
        $xxx = Xxxx::factory()->create();
        $this->get(route('xxx.show', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testUpdatePrescription(){
        $this->withoutExceptionHandling();
        $xxx = xxx::factory()->create();
        $data = [
            'xxx' => 'xxx',
        ];
        $xxx->xxx = 'xxx';
        $this->put(route('xxx.update', ['id' => $xxx->id]), $data)
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testDeletePrescription(){
        $this->withoutExceptionHandling();
        $xxx = Xxx::factory()->create();
        $this->delete(route('xxx.destroy', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }






    /**
     * @test
     */
    public function testListRemuneration(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('xxx.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreateRemuneration(){
        $this->withoutExceptionHandling();
        $data = [
            'xxx' => 'xxx',
        ];
        $this->post(route('xxx.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function testShowDetailsRemuneration(){
        $this->withoutExceptionHandling();
        $xxx = Xxxx::factory()->create();
        $this->get(route('xxx.show', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testUpdateRemuneration(){
        $this->withoutExceptionHandling();
        $xxx = xxx::factory()->create();
        $data = [
            'xxx' => 'xxx',
        ];
        $xxx->xxx = 'xxx';
        $this->put(route('xxx.update', ['id' => $xxx->id]), $data)
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testDeleteRemuneration(){
        $this->withoutExceptionHandling();
        $xxx = Xxx::factory()->create();
        $this->delete(route('xxx.destroy', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }






    /**
     * @test
     */
    public function testListSpeciality(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('xxx.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreateSpeciality(){
        $this->withoutExceptionHandling();
        $data = [
            'xxx' => 'xxx',
        ];
        $this->post(route('xxx.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function testShowDetailsSpeciality(){
        $this->withoutExceptionHandling();
        $xxx = Xxxx::factory()->create();
        $this->get(route('xxx.show', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testUpdateSpeciality(){
        $this->withoutExceptionHandling();
        $xxx = xxx::factory()->create();
        $data = [
            'xxx' => 'xxx',
        ];
        $xxx->xxx = 'xxx';
        $this->put(route('xxx.update', ['id' => $xxx->id]), $data)
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testDeleteSpeciality(){
        $this->withoutExceptionHandling();
        $xxx = Xxx::factory()->create();
        $this->delete(route('xxx.destroy', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }






    /**
     * @test
     */
    public function testListUser(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('xxx.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreateUser(){
        $this->withoutExceptionHandling();
        $data = [
            'xxx' => 'xxx',
        ];
        $this->post(route('xxx.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function testShowDetailsUser(){
        $this->withoutExceptionHandling();
        $xxx = Xxxx::factory()->create();
        $this->get(route('xxx.show', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testUpdateUser(){
        $this->withoutExceptionHandling();
        $xxx = xxx::factory()->create();
        $data = [
            'xxx' => 'xxx',
        ];
        $xxx->xxx = 'xxx';
        $this->put(route('xxx.update', ['id' => $xxx->id]), $data)
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testDeleteUser(){
        $this->withoutExceptionHandling();
        $xxx = Xxx::factory()->create();
        $this->delete(route('xxx.destroy', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }






    /**
     * @test
     */
    public function testListUserAvailability(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('xxx.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreateUserAvailability(){
        $this->withoutExceptionHandling();
        $data = [
            'xxx' => 'xxx',
        ];
        $this->post(route('xxx.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function testShowDetailsUserAvailability(){
        $this->withoutExceptionHandling();
        $xxx = Xxxx::factory()->create();
        $this->get(route('xxx.show', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testUpdateAvailability(){
        $this->withoutExceptionHandling();
        $xxx = xxx::factory()->create();
        $data = [
            'xxx' => 'xxx',
        ];
        $xxx->xxx = 'xxx';
        $this->put(route('xxx.update', ['id' => $xxx->id]), $data)
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testDeleteUserAvailability(){
        $this->withoutExceptionHandling();
        $xxx = Xxx::factory()->create();
        $this->delete(route('xxx.destroy', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }






    /**
     * @test
     */
    public function testListUserMeta(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('xxx.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreateUserMeta(){
        $this->withoutExceptionHandling();
        $data = [
            'xxx' => 'xxx',
        ];
        $this->post(route('xxx.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function testShowDetailsUserMeta(){
        $this->withoutExceptionHandling();
        $xxx = Xxxx::factory()->create();
        $this->get(route('xxx.show', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testUpdateUserMeta(){
        $this->withoutExceptionHandling();
        $xxx = xxx::factory()->create();
        $data = [
            'xxx' => 'xxx',
        ];
        $xxx->xxx = 'xxx';
        $this->put(route('xxx.update', ['id' => $xxx->id]), $data)
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testDeleteUserMeta(){
        $this->withoutExceptionHandling();
        $xxx = Xxx::factory()->create();
        $this->delete(route('xxx.destroy', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }






    /**
     * @test
     */
    public function testListUserSpecialty(){
        $this->withoutExceptionHandling();
        $response = $this->get(route('xxx.index'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function testCreateUserSpecialty(){
        $this->withoutExceptionHandling();
        $data = [
            'xxx' => 'xxx',
        ];
        $this->post(route('xxx.store'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function testShowDetailsUserSpecialty(){
        $this->withoutExceptionHandling();
        $xxx = Xxxx::factory()->create();
        $this->get(route('xxx.show', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testUpdateUserSpecialty(){
        $this->withoutExceptionHandling();
        $xxx = xxx::factory()->create();
        $data = [
            'xxx' => 'xxx',
        ];
        $xxx->xxx = 'xxx';
        $this->put(route('xxx.update', ['id' => $xxx->id]), $data)
            ->assertStatus(200)
            ->assertJson($xxx);
    }

    /**
     * @test
     */
    public function testDeleteUserSpecialty(){
        $this->withoutExceptionHandling();
        $xxx = Xxx::factory()->create();
        $this->delete(route('xxx.destroy', ['id' => $xxx->id]))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }

}
