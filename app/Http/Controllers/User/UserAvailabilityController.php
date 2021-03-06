<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserAvailabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $UserAvailability = UserAvailability::paginate();
        return response()->json($UserAvailability);
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
            'weekday' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $UserAvailability = new UserAvailability();
        $UserAvailability->user_id = $request->user_id;
        $UserAvailability->weekday = $request->weekday;
        $UserAvailability->start_time = $request->start_time;
        $UserAvailability->end_time = $request->end_time;
        $UserAvailability->save();
        return response()->json($UserAvailability);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $UserAvailability = UserAvailability::find($id);
        if($UserAvailability){
            return response()->json($UserAvailability);
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
        $UserAvailability = UserAvailability::find($id);
        if($UserAvailability) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'weekday' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $UserAvailability->doctor_id = $request->doctor_id;
            $UserAvailability->user_id = $request->user_id;
            $UserAvailability->weekday = $request->weekday;
            $UserAvailability->start_time = $request->start_time;
            $UserAvailability->end_time = $request->end_time;
            $UserAvailability->save();
            return response()->json(array_merge($UserAvailability));
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
        $UserAvailability = UserAvailability::find($id);
        if($UserAvailability){
            $UserAvailability->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
