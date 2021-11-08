<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Remuneration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RemunerationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $Remuneration = Remuneration::paginate();
        return response()->json($Remuneration);
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
            'status' => 'required',
            'amount' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $Remuneration = new Remuneration();
        $Remuneration->user_id = $request->user_id;
        $Remuneration->doctor_id = $request->doctor_id;
        $Remuneration->attendance_id = $request->attendance_id;
        $Remuneration->status = $request->status;
        $Remuneration->amount = $request->amount;
        $Remuneration->save();
        return response()->json($Remuneration);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $Remuneration = Remuneration::find($id);
        if($Remuneration){
            return response()->json($Remuneration);
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
        $Remuneration = Remuneration::find($id);
        if($Remuneration) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'doctor_id' => 'required',
                'attendance_id' => 'required',
                'status' => 'required',
                'amount' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $Remuneration->doctor_id = $request->doctor_id;
            $Remuneration->user_id = $request->user_id;
            $Remuneration->doctor_id = $request->doctor_id;
            $Remuneration->attendance_id = $request->attendance_id;
            $Remuneration->status = $request->status;
            $Remuneration->amount = $request->amount;
            $Remuneration->save();
            return response()->json(array_merge($Remuneration));
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
        $Remuneration = Remuneration::find($id);
        if($Remuneration){
            $Remuneration->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
