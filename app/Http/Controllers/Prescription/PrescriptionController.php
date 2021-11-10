<?php

namespace App\Http\Controllers\Prescription;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $Prescription = Prescription::paginate();
        return response()->json($Prescription);
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
            'comments' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $Prescription = new Prescription();
        $Prescription->user_id = $request->user_id;
        $Prescription->doctor_id = $request->doctor_id;
        $Prescription->hash = Str::random(5);
        $Prescription->comments = $request->comments;
        $Prescription->save();
        return response()->json($Prescription, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $prescriptionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($prescriptionId)
    {
        $Prescription = Prescription::find($prescriptionId);
        if($Prescription){
            return response()->json($Prescription);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $prescriptionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $prescriptionId)
    {
        $Prescription = Prescription::find($prescriptionId);
        if($Prescription) {
            $validator = Validator::make($request->all(), [
                'comments' => 'Required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $Prescription->comments = $request->comments;
            $Prescription->save();
            $Prescription->message = 'Updated';
            return response()->json($Prescription);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $prescriptionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($prescriptionId)
    {
        $Prescription = Prescription::find($prescriptionId);
        if($Prescription){
            $Prescription->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
