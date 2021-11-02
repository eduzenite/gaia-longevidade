<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Anamnesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnamnesisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $Anamnesis = Anamnesis::where(function ($query) use ($request) {
            if($request->user){
                $query->where('user', $request->user);
            }
            if($request->doctor){
                $query->where('doctor', $request->doctor);
            }
        })->paginate();
        return response()->json($Anamnesis);
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
            'user_id' => 'required|numeric',
            'doctor_id' => 'required|numeric',
            'attendance_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'Bad Request', 'messages' => $validator->errors()], 400);
        }
        $Anamnesis = new Anamnesis();
        $Anamnesis->user_id = $request->user_id;
        $Anamnesis->doctor_id = $request->doctor_id;
        $Anamnesis->attendance_id = $request->attendance_id;
        $Anamnesis->save();
        return response()->json($Anamnesis);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $Anamnesis = Anamnesis::with('attendance')->with('user')->find($id);
        if($Anamnesis){
            return response()->json($Anamnesis);
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
        $Anamnesis = Anamnesis::find($id);
        if($Anamnesis) {
            $validator = Validator::make($request->all(), [
                'doctor_id' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => 'Bad Request', 'messages' => $validator->errors()], 400);
            }
            $Anamnesis->doctor_id = $request->doctor_id;
            $Anamnesis->save();
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
        $Anamnesis = Anamnesis::find($id);
        if($Anamnesis){
            $Anamnesis->delete();
            return response()->json(['deleted' => true]);
        }else{
            return response()->json(['error' => 'Not Found'], 404);
        }
    }
}
