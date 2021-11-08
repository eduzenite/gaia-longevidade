<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\AttendanceDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $AttendanceDetails = AttendanceDetails::paginate();
        return response()->json($AttendanceDetails);
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
            'attendance_id' => 'required',
            'title' => 'required',
            'contents' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $AttendanceDetails = new AttendanceDetails();
        $AttendanceDetails->attendance_id = $request->attendance_id;
        $AttendanceDetails->title = $request->title;
        $AttendanceDetails->contents = $request->contents;
        $AttendanceDetails->save();
        return response()->json($AttendanceDetails, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $attendanceId
     * @param  int  $attendanceDetailId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($attendanceId, $attendanceDetailId)
    {
        $AttendanceDetails = AttendanceDetails::where('attendance_id', $attendanceId)->find($attendanceDetailId);
        if($AttendanceDetails){
            return response()->json($AttendanceDetails);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $attendanceId
     * @param  int  $attendanceDetailId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $attendanceId, $attendanceDetailId)
    {
        $AttendanceDetails = AttendanceDetails::where('attendance_id', $attendanceId)->find($attendanceDetailId);
        if($AttendanceDetails) {
            $validator = Validator::make($request->all(), [
                'attendance_id' => 'Required',
                'title' => 'Required',
                'contents' => 'Required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $AttendanceDetails->attendance_id = $request->attendance_id;
            $AttendanceDetails->title = $request->title;
            $AttendanceDetails->contents = $request->contents;
            $AttendanceDetails->save();
            $AttendanceDetails->message = 'Updated';
            return response()->json($AttendanceDetails);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $attendanceId
     * @param  int  $attendanceDetailId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($attendanceId, $attendanceDetailId)
    {
        $AttendanceDetails = AttendanceDetails::where('attendance_id', $attendanceId)->find($attendanceDetailId);
        if($AttendanceDetails){
            $AttendanceDetails->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
