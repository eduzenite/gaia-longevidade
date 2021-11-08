<?php

$array = [
    ['class' => 'Anamnesis', 'fields' => [
        'user_id' => '\App\Models\User::factory()->create()->id',
        'doctor_id' => '\App\Models\User::factory()->create()->id',
        'attendance_id' => '\App\Models\Attendance::factory()->create()->id',
    ]],
    ['class' => 'AnamnesisAnswers', 'fields' => [
        'anamnesis_question_id' => '\App\Models\AnamnesisQuestions::factory()->create()->id',
        'answers' => 'json_encode(["pt_BR" => [$faker->sentence(2, true), "en_US" => $faker->sentence(3, true)]])'
    ]],
    ['class' => 'AnamnesisMeta', 'fields' => [
        'anamnesis_id' => '\App\Models\Anamnesis::factory()->create()->id',
        'meta' => '$faker->sentence(5, true)',
        'value' => '$faker->sentence(500, true)'
    ]],
    ['class' => 'AnamnesisQuestions', 'fields' => [
        'type' => 'rand(1, 10)',
        'question' => 'json_encode($question = ["en_US" => $faker->sentence(100, true), "pt_BR" => $faker->sentence(100, true)])',
        'anamnesis_question_id' => '\App\Models\AnamnesisQuestions::factory()->create()->id',
    ]],
    ['class' => 'Attendance', 'fields' => [
        'user_id' => '\App\Models\User::factory()->create()->id',
        'doctor_id' => '\App\Models\User::factory()->create()->id',
        'status' => rand(1, 4),
        'appointment' => '$date->format("Y-m-d H:i")',
        'time' => 'rand(1, 2).":".$timeMinutes[rand(0, 1)]',
        'type' => 'rand(1, 3)',
        'speciality_id' => 'Speciality::factory()',
        'amount' => 'rand(150, 350).".".rand(10, 99)',
        'event_id' => 'rand(10000000, 99999999)',
    ]],
    ['class' => 'AttendanceDetails', 'fields' => [
        'attendance_id' => '\App\Models\Attendance::factory()->create()->id',
        'title' => '$faker->sentence(5, true)',
        'contents' => '$faker->sentence(500, true)',
    ]],
    ['class' => 'AttendanceFile', 'fields' => [
        'user_id' => '\App\Models\User::factory()->create()->id',
        'attendance_id' => '\App\Models\Attendance::factory()->create()->id',
        'files_id' => '\App\Models\File::factory()->create()->id',
        'type' => 'rand(1, 2)'
    ]],
    ['class' => 'Diary', 'fields' => [
        'user_id' => '\App\Models\User::factory()->create()->id',
        'appointment' => 'date("Y-m-d H:i:s")',
        'description' => '$faker->sentence(500, true)',
        'feeling' => 'rand(1, 9)'
    ]],
    ['class' => 'DiaryMeta', 'fields' => [
        'diary_id' => '\App\Models\Diary::factory()->create()->id',
        'meta' => '$faker->sentence(5, true)',
        'value' => 'json_encode(["value1" => $faker->sentence(50, true), "value2" => $faker->sentence(50, true)])',
    ]],
    ['class' => 'File', 'fields' => [
        'title' => '$faker->sentence(6, true)',
        'type' => '$faker->mimeType',
        'info' => 'xxx'
    ]],
    ['class' => 'Medicine', 'fields' => [
        'prescription_id' => '\App\Models\Pescription::factory()->create()->id',
        'title' => '$faker->sentence(100, true)',
        'dosage' => '$faker->sentence(100, true)',
        'schedules' => '$faker->sentence(100, true)',
        'quantity' => '$faker->sentence(100, true)',
    ]],
    ['class' => 'Menu', 'fields' => [
        'user_id' => '\App\Models\User::factory()->create()->id',
        'doctor_id' => '\App\Models\User::factory()->create()->id',
        'validity' => 'date("Y-m-d")',
        'comments' => '$faker->sentence(100, true)'
    ]],
    ['class' => 'MenuFood', 'fields' => [
        'menu_id' => '\App\Models\Menu::factory()->create()->id',
        'title' => '$faker->sentence(20, true)',
        'amount' => 'rand(50, 200)." g"',
        'calorie' => 'rand(550, 1000)." calorias"',
        'time' => "json_encode([rand(1, 4), rand(5, 8)])"
    ]],
    ['class' => 'Prescription', 'fields' => [
        'user_id' => '\App\Models\User::factory()->create()->id',
        'doctor_id' => '\App\Models\User::factory()->create()->id',
        'hash' => '$faker->sha256',
        'comments' => '$faker->sentence(500, true)'
    ]],
    ['class' => 'Remuneration', 'fields' => [
        'user_id' => '\App\Models\User::factory()->create()->id',
        'doctor_id' => '\App\Models\User::factory()->create()->id',
        'attendance_id' => '\App\Models\Attendance::factory()->create()->id',
        'status' => 'rand(1, 13)',
        'amount' => '$faker->randomFloat($nbMaxDecimals = 2, $min = 150, $max = 350)'
    ]],
    ['class' => 'Speciality', 'fields' => [
        'title' => 'json_encode(["pt_BR" => $faker->sentence(5, true), "en_US" => $faker->sentence(5, true)])'
    ]],
    ['class' => 'User', 'fields' => [
        'name' => '$faker->name()',
        'photo' => '$faker->image($filePath,500,500)',
        'phone' => '$faker->phoneNumber',
        'email' => '$faker->unique()->safeEmail()',
        'role' => 'rand(1, 4)',
        'timezone' => '$faker->timezone',
        'email_verified_at' => 'now()',
        'password' => '"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi"',
        'remember_token' => 'Str::random(10)',
    ]],
    ['class' => 'UserAvailability', 'fields' => [
        'user_id' => '\App\Models\User::factory()->create()->id',
        'weekday' => 'rand(1, 7)',
        'start_time' => '$faker->time("H:i")',
        'end_time' => '$faker->time("H:i")',
    ]],
    ['class' => 'UserMeta', 'fields' => [
        'user_id' => '\App\Models\User::factory()->create()->id',
        'meta' => '$faker->sentence(5, true)',
        'value' => 'json_encode(["value1" => $faker->sentence(50, true), "value2" => $faker->sentence(50, true)])',
    ]],
    ['class' => 'UserSpeciality', 'fields' => [
        'user_id' => '\App\Models\User::factory()->create()->id',
        'speciality_id' => '\App\Models\Speciality::factory()->create()->id',
    ]],
];

foreach ($array as $item){
    echo 'php artisan test --filter '.$item['class'] . 'Test::testList' .$item['class'].'<br>';
    echo 'php artisan test --filter '.$item['class'] . 'Test::testCreate' .$item['class'].'<br>';
    echo 'php artisan test --filter '.$item['class'] . 'Test::testShowDetails' .$item['class'].'<br>';
    echo 'php artisan test --filter '.$item['class'] . 'Test::testUpdate' .$item['class'].'<br>';
    echo 'php artisan test --filter '.$item['class'] . 'Test::testDelete' .$item['class'].'<br>';
    echo '<br><br>';
}

foreach ($array as $item){
    ?>
<pre>
    //<?php echo $item['class'] ?>Test------------------------------------





     /**
     * @test
     */
    public function testList<?php echo $item['class'] ?>()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('<?php echo strtolower($item['class']) ?>.index'));
        $response->assertStatus(200);
        $fields = ['message', 'status', 'current_page', 'data', 'to', 'total', 'first_page_url', 'from', 'last_page', 'last_page_url', 'links', 'next_page_url', 'path', 'per_page', 'prev_page_url'];
        $response->assertJson(fn (AssertableJson $json) => $json->hasAny($fields));
    }

    /**
     * @test
     */
    public function testCreate<?php echo $item['class'] ?>()
    {
        $this->withoutExceptionHandling();
        $data = [
<?php foreach ($item['fields'] as $key => $field){ ?>
            '<?php echo $key ?>' => <?php echo $field ?>,
<?php } ?>
        ];
        $response = $this->post(route('<?php echo strtolower($item['class']) ?>.store'), $data);
        $response->assertStatus(201);
        $fields = ['message', 'id', 'created_at', 'updated_at'<?php foreach ($item['fields'] as $key => $field){ ?>, '<?php echo $key ?>'<?php } ?>];
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
        $fields = ['message', 'id', 'created_at', 'updated_at'<?php foreach ($item['fields'] as $key => $field){ ?>, '<?php echo $key ?>'<?php } ?>];
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
<?php foreach ($item['fields'] as $key => $field){ ?>
            '<?php echo $key ?>' => <?php echo $field ?>,
<?php } ?>
        ];
        $response = $this->put(route('<?php echo strtolower($item['class']) ?>.update', ['id' => $<?php echo $item['class'] ?>->id]), $data);
        $response->assertStatus(200);
        $fields = ['message', 'id', 'created_at', 'updated_at', 'updated'<?php foreach ($item['fields'] as $key => $field){ ?>, '<?php echo $key ?>'<?php } ?>];
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
        $response->assertJson(['message' => 'Deleted']);
    }










</pre>
<?php
}
