<?php

namespace App\Http\Controllers\Diary;

use App\Http\Controllers\Controller;
use App\Models\DiaryMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiaryMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $DiaryMeta = DiaryMeta::paginate();
        return response()->json($DiaryMeta);
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
            'diary_id' => 'required',
            'meta' => 'required',
            'value' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $DiaryMeta = new DiaryMeta();
        $DiaryMeta->diary_id = $request->diary_id;
        $DiaryMeta->meta = $request->meta;
        $DiaryMeta->value = $request->value;
        $DiaryMeta->save();
        return response()->json($DiaryMeta, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $diaryId
     * @param  int  $diaryMetaId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($diaryId, $diaryMetaId)
    {
        $DiaryMeta = DiaryMeta::where('diary_id', $diaryId)->find($diaryMetaId);
        if($DiaryMeta){
            return response()->json($DiaryMeta);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $diaryId
     * @param  int  $diaryMetaId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $diaryId, $diaryMetaId)
    {
        $DiaryMeta = DiaryMeta::where('diary_id', $diaryId)->find($diaryMetaId);
        if($DiaryMeta) {
            $validator = Validator::make($request->all(), [
                'diary_id' => 'required',
                'meta' => 'required',
                'value' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $DiaryMeta->diary_id = $request->diary_id;
            $DiaryMeta->meta = $request->meta;
            $DiaryMeta->value = $request->value;
            $DiaryMeta->save();
            $DiaryMeta->message = 'Updated';
            return response()->json($DiaryMeta);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $diaryId
     * @param  int  $diaryMetaId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($diaryId, $diaryMetaId)
    {
        $DiaryMeta = DiaryMeta::where('diary_id', $diaryId)->find($diaryMetaId);
        if($DiaryMeta){
            $DiaryMeta->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
