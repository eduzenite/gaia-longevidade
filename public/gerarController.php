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
    ['class' => 'UserSpeciality', 'fields' => ['user_id', 'specialty_id']],
];

foreach ($array as $item){
    ?>
<pre>
    //<?php echo $item['class'] ?>Controller------------------------------------




     /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $<?php echo $item['class'] ?> = <?php echo $item['class'] ?>::paginate();
        return response()->json($<?php echo $item['class'] ?>);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
<?php foreach ($item['fields'] as $field){ ?>
            '<?php echo $field ?>' => 'required',
<?php } ?>
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $<?php echo $item['class'] ?> = new <?php echo $item['class'] ?>();
<?php foreach ($item['fields'] as $field){ ?>
        $<?php echo $item['class'] ?>-><?php echo $field ?> = $request-><?php echo $field ?>;
<?php } ?>
        $<?php echo $item['class'] ?>->save();
        return response()->json($<?php echo $item['class'] ?>, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $<?php echo $item['class'] ?> = <?php echo $item['class'] ?>::find($id);
        if($<?php echo $item['class'] ?>){
            return response()->json($<?php echo $item['class'] ?>);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $<?php echo $item['class'] ?> = <?php echo $item['class'] ?>::find($id);
        if($<?php echo $item['class'] ?>) {
            $validator = Validator::make($request->all(), [
<?php foreach ($item['fields'] as $field){ ?>
                '<?php echo $field ?>' => 'required',
<?php } ?>
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
<?php foreach ($item['fields'] as $field){ ?>
            $<?php echo $item['class'] ?>-><?php echo $field ?> = $request-><?php echo $field ?>;
<?php } ?>
            $<?php echo $item['class'] ?>->save();
            $<?php echo $item['class'] ?>->message = 'Updated';
            return response()->json($<?php echo $item['class'] ?>);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $<?php echo $item['class'] ?> = <?php echo $item['class'] ?>::find($id);
        if($<?php echo $item['class'] ?>){
            $<?php echo $item['class'] ?>->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }










</pre>
<?php
}
