<?php

namespace App\Http\Controllers\Anamnesis;

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
        $Anamnesis = Anamnesis::paginate();
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
            'user_id' => 'required',
            'doctor_id' => 'required',
            'attendance_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $Anamnesis = new Anamnesis();
        $Anamnesis->user_id = $request->user_id;
        $Anamnesis->doctor_id = $request->doctor_id;
        $Anamnesis->attendance_id = $request->attendance_id;
        $Anamnesis->save();
        return response()->json($Anamnesis, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $anamnesisId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($anamnesisId)
    {
        $Anamnesis = Anamnesis::find($anamnesisId);
        if($Anamnesis){
            return response()->json($Anamnesis);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $anamnesisId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $anamnesisId)
    {
        $Anamnesis = Anamnesis::find($anamnesisId);
        if($Anamnesis) {
            $validator = Validator::make($request->all(), [
                'doctor_id' => 'Required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $Anamnesis->doctor_id = $request->doctor_id;
            $Anamnesis->save();
            $Anamnesis->message = 'Updated';
            return response()->json($Anamnesis);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $anamnesisId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($anamnesisId)
    {
        $Anamnesis = Anamnesis::find($anamnesisId);
        if($Anamnesis){
            $Anamnesis->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
