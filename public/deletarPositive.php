<?php

$array = [
    ['class' => 'Anamnesis', 'fields' => ['user_id', 'doctor_id', 'attendance_id']],
    ['class' => 'AnamnesisAnswers', 'fields' => ['anamnesis_question_id', 'answers']],
    ['class' => 'AnamnesisMeta', 'fields' => ['anamnesis_id', 'meta', 'value']],
    ['class' => 'AnamnesisQuestions', 'fields' => ['type', 'question', 'anamnesis_question_id']],
    ['class' => 'Attendance', 'fields' => ['user_id', 'doctor_id', 'status', 'appointment', 'time', 'type', 'speciality_id', 'amount', 'event_id']],
    ['class' => 'AttendanceDetails', 'fields' => ['attendance_id', 'title', 'contents']],
    ['class' => 'AttendanceFile', 'fields' => ['user_id', 'attendance_id', 'files_id', 'type']],
    ['class' => 'Diary', 'fields' => ['user_id', 'appointment', 'description', 'feeling']],
    ['class' => 'DiaryMeta', 'fields' => ['diary_id', 'meta', 'value']],
    ['class' => 'File', 'fields' => ['title', 'type', 'info']],
    ['class' => 'Medicine', 'fields' => ['prescription_id', 'title', 'dosage', 'schedules', 'quantity']],
    ['class' => 'Menu', 'fields' => ['user_id', 'doctor_id', 'validity', 'comments']],
    ['class' => 'MenuFood', 'fields' => ['menu_id', 'title', 'amount', 'calorie', 'time']],
    ['class' => 'Prescription', 'fields' => ['user_id', 'doctor_id', 'hash', 'comments']],
    ['class' => 'Remuneration', 'fields' => ['user_id', 'doctor_id', 'attendance_id', 'status', 'amount']],
    ['class' => 'Speciality', 'fields' => ['title']],
    ['class' => 'User', 'fields' => ['name', 'photo', 'phone', 'email', 'password', 'role', 'timezone']],
    ['class' => 'UserAvailability', 'fields' => ['user_id', 'weekday', 'start_time', 'end_time']],
    ['class' => 'UserMeta', 'fields' => ['user_id', 'meta', 'value']],
    ['class' => 'UserSpecialty', 'fields' => ['user_id', 'specialty_id']],
];

foreach ($array as $item){
    ?>
<pre>
     /**
     * @test
     */
    public function testList<?php echo $item['class'] ?>()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('<?php echo strtolower($item['class']) ?>.index'));
        $response->assertStatus(200);
        $fields = ['status', 'current_page', 'data', 'to', 'total'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreate<?php echo $item['class'] ?>()
    {
        $this->withoutExceptionHandling();
        $data = [
<?php foreach ($item['fields'] as $field){ ?>
            '<?php echo $field ?>' => 'xxx',
<?php } ?>
        ];
        $response = $this->post(route('<?php echo strtolower($item['class']) ?>.store'), $data);
        $response->assertStatus(201);
        $fields = ['id', 'created_at', 'updated_at'<?php foreach ($item['fields'] as $field){ ?>, '<?php echo $field ?>'<?php } ?>];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testShowDetails<?php echo $item['class'] ?>()
    {
        $this->withoutExceptionHandling();
        $<?php echo $item['class'] ?> = <?php echo $item['class'] ?>::factory()->create();
        $response = $this->get(route('<?php echo strtolower($item['class']) ?>.show', ['id' => $<?php echo $item['class'] ?>->id]));
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at'<?php foreach ($item['fields'] as $field){ ?>, '<?php echo $field ?>'<?php } ?>];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testUpdate<?php echo $item['class'] ?>()
    {
        $this->withoutExceptionHandling();
        $<?php echo $item['class'] ?> = <?php echo $item['class'] ?>::factory()->create();
        $data = [
<?php foreach ($item['fields'] as $field){ ?>
            '<?php echo $field ?>' => 'xxx',
<?php } ?>
        ];
        $response = $this->put(route('<?php echo strtolower($item['class']) ?>.update', ['id' => $<?php echo $item['class'] ?>->id]), $data);
        $response->assertStatus(200);
        $fields = ['id', 'created_at', 'updated_at'<?php foreach ($item['fields'] as $field){ ?>, '<?php echo $field ?>'<?php } ?>];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testDelete<?php echo $item['class'] ?>()
    {
        $this->withoutExceptionHandling();
        $<?php echo $item['class'] ?> = <?php echo $item['class'] ?>::factory()->create();
        $response = $this->delete(route('<?php echo strtolower($item['class']) ?>.destroy', ['id' => $<?php echo $item['class'] ?>->id]));
        $response->assertStatus(200);
        $response->assertJson(['deleted' => true]);
    }










</pre>
<?php
}
