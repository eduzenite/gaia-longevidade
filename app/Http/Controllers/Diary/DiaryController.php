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
        $Diary = Diary::where(function ($query) use ($request) {
            if($request->type){
                $query->where('type', $request->type);
            }
            if($request->appointment){
                $query->whereBetween('appointment', array($request->appointment->start_date, $request->appointment->and_date.' 23:59'));
            }
        })->paginate();
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
            'appointment' => 'required|date_format:Y-m-d H:i',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'Bad Request', 'messages' => $validator->errors()], 400);
        }
        $Diary = new Diary();
        $Diary->user_id = $request->user_id;
        $Diary->appointment = $request->appointment;
        $Diary->description = $request->description;
        $Diary->save();
        return response()->json($Diary);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $Diary = Diary::with('file')->with('speciality')->find($id);
        if($Diary){
            return response()->json($Diary);
        }else{
            return response()->json(['error' => 'Not Found'], 404);
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
        $Diary = Diary::find($id);
        if($Diary) {
            $validator = Validator::make($request->all(), [
                'appointment' => 'required|date_format:Y-m-d H:i',
                'description' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => 'Bad Request', 'messages' => $validator->errors()], 400);
            }
            $Diary->appointment = $request->appointment;
            $Diary->description = $request->description;
            $Diary->save();
            return response()->json(array_merge($request->all(), ['updated' => true]));
        }else{
            return response()->json(['error' => 'Not Found'], 404);
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
        $Diary = Diary::find($id);
        if($Diary){
            $Diary->delete();
            return response()->json(['deleted' => true]);
        }else{
            return response()->json(['error' => 'Not Found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function feelings()
    {
        return response()->json(config('app.feelings'));
    }
}
