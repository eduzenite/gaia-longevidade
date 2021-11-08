<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            $Attendance = Attendance::paginate();
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
                'user_id' => 'required',
                'doctor_id' => 'required',
                'status' => 'required',
                'appointment' => 'required',
                'time' => 'required',
                'type' => 'required',
                'speciality_id' => 'required',
                'amount' => 'required',
                'event_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $Attendance = new Attendance();
            $Attendance->user_id = $request->user_id;
            $Attendance->doctor_id = $request->doctor_id;
            $Attendance->status = $request->status;
            $Attendance->appointment = $request->appointment;
            $Attendance->time = $request->time;
            $Attendance->type = $request->type;
            $Attendance->speciality_id = $request->speciality_id;
            $Attendance->amount = $request->amount;
            $Attendance->event_id = $request->event_id;
            $Attendance->save();
            return response()->json($Attendance, 201);
        }

        /**
         * Display the specified resource.
         *
         * @param  int  $attendanceId
         * @return \Illuminate\Http\JsonResponse
         */
        public function show($attendanceId)
        {
            $Attendance = Attendance::find($attendanceId);
            if($Attendance){
                return response()->json($Attendance);
            }else{
                return response()->json(['message' => 'Not Found'], 404);
            }
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $attendanceId
         * @return \Illuminate\Http\JsonResponse
         */
        public function update(Request $request, $attendanceId)
        {
            $Attendance = Attendance::find($attendanceId);
            if($Attendance) {
                $validator = Validator::make($request->all(), [
                    'user_id' => 'Required',
                    'doctor_id' => 'Required',
                    'status' => 'Required',
                    'appointment' => 'Required',
                    'time' => 'Required',
                    'type' => 'Required',
                    'speciality_id' => 'Required',
                    'amount' => 'Required',
                    'event_id' => 'Required',
                ]);
                if ($validator->fails()) {
                    return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
                }
                $Attendance->user_id = $request->user_id;
                $Attendance->doctor_id = $request->doctor_id;
                $Attendance->status = $request->status;
                $Attendance->appointment = $request->appointment;
                $Attendance->time = $request->time;
                $Attendance->type = $request->type;
                $Attendance->speciality_id = $request->speciality_id;
                $Attendance->amount = $request->amount;
                $Attendance->event_id = $request->event_id;
                $Attendance->save();
                $Attendance->message = 'Updated';
                return response()->json($Attendance);
            }else{
                return response()->json(['message' => 'Not Found'], 404);
            }
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $attendanceId
         * @return \Illuminate\Http\JsonResponse
         */
        public function destroy($attendanceId)
        {
            $Attendance = Attendance::find($attendanceId);
            if($Attendance){
                $Attendance->delete();
                return response()->json(['message' => 'Deleted']);
            }else{
                return response()->json(['message' => 'Not Found'], 404);
            }
        }

}
