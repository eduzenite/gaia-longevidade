<?php

namespace App\Http\Controllers\Anamnesis;

use App\Http\Controllers\Controller;
use App\Models\AnamnesisAnswers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnamnesisAnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $AnamnesisAnswers = AnamnesisAnswers::paginate();
        return response()->json($AnamnesisAnswers);
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
            'anamnesis_question_id' => 'required',
            'answers' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $AnamnesisAnswers = new AnamnesisAnswers();
        $AnamnesisAnswers->anamnesis_question_id = $request->anamnesis_question_id;
        $AnamnesisAnswers->answers = $request->answers;
        $AnamnesisAnswers->save();
        return response()->json($AnamnesisAnswers, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $anamnesisQuestionId
     * @param  int  $anamnesisQuestionAnswerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($anamnesisQuestionId, $anamnesisQuestionAnswerId)
    {
        $AnamnesisAnswers = AnamnesisAnswers::where('anamnesis_question_id', $anamnesisQuestionId)->find($anamnesisQuestionAnswerId);
        if($AnamnesisAnswers){
            return response()->json($AnamnesisAnswers);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $anamnesisQuestionId
     * @param  int  $anamnesisQuestionAnswerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $anamnesisQuestionId, $anamnesisQuestionAnswerId)
    {
        $AnamnesisAnswers = AnamnesisAnswers::where('anamnesis_question_id', $anamnesisQuestionId)->find($anamnesisQuestionAnswerId);
        if($AnamnesisAnswers) {
            $validator = Validator::make($request->all(), [
                'anamnesis_question_id' => 'Required',
                'answers' => 'Required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $AnamnesisAnswers->anamnesis_question_id = $request->anamnesis_question_id;
            $AnamnesisAnswers->answers = $request->answers;
            $AnamnesisAnswers->save();
            $AnamnesisAnswers->message = 'Updated';
            return response()->json($AnamnesisAnswers);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $anamnesisQuestionId
     * @param  int  $anamnesisQuestionAnswerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($anamnesisQuestionId, $anamnesisQuestionAnswerId)
    {
        $AnamnesisAnswers = AnamnesisAnswers::where('anamnesis_question_id', $anamnesisQuestionId)->find($anamnesisQuestionAnswerId);
        if($AnamnesisAnswers){
            $AnamnesisAnswers->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
