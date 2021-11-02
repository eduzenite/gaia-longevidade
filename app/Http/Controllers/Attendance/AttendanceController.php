<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Attendance\GoogleCalendarController;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $Attendance = Attendance::where(function ($query) use ($request) {
            if($request->status){
                $query->where('status', $request->status);
            }
            if($request->type){
                $query->where('type', $request->type);
            }
            if($request->appointment){
                $query->whereBetween('appointment', array($request->appointment->start_date, $request->appointment->and_date.' 23:59'));
            }
        })->paginate();

        return response()->json($Attendance);
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
            'appointment' => 'required|date_format:Y-m-d H:i',
            'time' => 'required',
            'type' => 'required|numeric|max:2',
            'speciality_id' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'Bad Request', 'messages' => $validator->errors()], 400);
        }
        $Attendance = new Attendance();
        $Attendance->user_id = $request->user_id;
        $Attendance->doctor_id = $request->doctor_id;
        $Attendance->appointment = $request->appointment;
        $Attendance->time = $request->time;
        $Attendance->type = $request->type;
        $Attendance->speciality_id = $request->speciality_id;
        $Attendance->amount = $request->amount;
//        $event = GoogleCalendarController::store($request);
//        $Attendance->event_id = $event;
        $Attendance->save();
        return response()->json($Attendance);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $Attendance = Attendance::with('attendance_details')->find($id);
        if($Attendance){
            return response()->json($Attendance);
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
        $Attendance = Attendance::find($id);
        if($Attendance) {
            $validator = Validator::make($request->all(), [
                'appointment' => 'required|date_format:Y-m-d H:i',
                'time' => 'required',
                'type' => 'required|numeric|max:2',
                'amount' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => 'Bad Request', 'messages' => $validator->errors()], 400);
            }
            $Attendance->appointment = $request->appointment;
            $Attendance->time = $request->time;
            $Attendance->type = $request->type;
            $Attendance->amount = $request->amount;
            $Attendance->save();
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
        $Attendance = Attendance::find($id);
        if($Attendance){
            $Attendance->delete();
            return response()->json(['deleted' => true]);
        }else{
            return response()->json(['error' => 'Not Found'], 404);
        }
    }
}
