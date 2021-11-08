<?php

namespace App\Http\Controllers\Anamnesis;

use App\Http\Controllers\Controller;
use App\Models\AnamnesisQuestions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnamnesisQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $AnamnesisQuestions = AnamnesisQuestions::paginate();
        return response()->json($AnamnesisQuestions);
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
            'type' => 'required',
            'question' => 'required',
            'anamnesis_question_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $AnamnesisQuestions = new AnamnesisQuestions();
        $AnamnesisQuestions->type = $request->type;
        $AnamnesisQuestions->question = $request->question;
        $AnamnesisQuestions->anamnesis_question_id = $request->anamnesis_question_id;
        $AnamnesisQuestions->save();
        return response()->json($AnamnesisQuestions, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $anamnesisQuestionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($anamnesisQuestionId)
    {
        $AnamnesisQuestions = AnamnesisQuestions::find($anamnesisQuestionId);
        if($AnamnesisQuestions){
            return response()->json($AnamnesisQuestions);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $anamnesisQuestionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $anamnesisQuestionId)
    {
        $AnamnesisQuestions = AnamnesisQuestions::find($anamnesisQuestionId);
        if($AnamnesisQuestions) {
            $validator = Validator::make($request->all(), [
                'type' => 'Required',
                'question' => 'Required',
                'anamnesis_question_id' => 'Required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $AnamnesisQuestions->type = $request->type;
            $AnamnesisQuestions->question = $request->question;
            $AnamnesisQuestions->anamnesis_question_id = $request->anamnesis_question_id;
            $AnamnesisQuestions->save();
            $AnamnesisQuestions->message = 'Updated';
            return response()->json($AnamnesisQuestions);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $anamnesisQuestionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($anamnesisQuestionId)
    {
        $AnamnesisQuestions = AnamnesisQuestions::find($anamnesisQuestionId);
        if($AnamnesisQuestions){
            $AnamnesisQuestions->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
