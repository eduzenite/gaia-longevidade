<?php

namespace App\Http\Controllers\Diary;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $Diary = Diary::paginate();
        return response()->json($Diary);
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
            'user_id' => 'required',
            'appointment' => 'required',
            'description' => 'required',
            'feeling' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $Diary = new Diary();
        $Diary->user_id = $request->user_id;
        $Diary->appointment = $request->appointment;
        $Diary->description = $request->description;
        $Diary->feeling = $request->feeling;
        $Diary->save();
        return response()->json($Diary, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $diaryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($diaryId)
    {
        $Diary = Diary::find($diaryId);
        if($Diary){
            return response()->json($Diary);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $diaryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $diaryId)
    {
        $Diary = Diary::find($diaryId);
        if($Diary) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'appointment' => 'required',
                'description' => 'required',
                'feeling' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $Diary->user_id = $request->user_id;
            $Diary->appointment = $request->appointment;
            $Diary->description = $request->description;
            $Diary->feeling = $request->feeling;
            $Diary->save();
            $Diary->message = 'Updated';
            return response()->json($Diary);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $diaryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($diaryId)
    {
        $Diary = Diary::find($diaryId);
        if($Diary){
            $Diary->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
