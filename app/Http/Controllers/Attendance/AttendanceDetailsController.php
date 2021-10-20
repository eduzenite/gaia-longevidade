<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\AttendanceDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceDetailsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'contents' => 'required|string',
            'attendance_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'Bad Request', 'messages' => $validator->errors()], 400);
        }
        $Attendance = new AttendanceDetails();
        $Attendance->attendance_id = $request->attendance_id;
        $Attendance->title = $request->title;
        $Attendance->contents = $request->contents;
        $Attendance->save();
        return response()->json($Attendance);
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
        $Attendance = AttendanceDetails::find($id);
        if($Attendance) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'contents' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => 'Bad Request', 'messages' => $validator->errors()], 400);
            }
            $Attendance->title = $request->title;
            $Attendance->contents = $request->contents;
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
        $AttendanceDetails = AttendanceDetails::find($id);
        if($AttendanceDetails){
            $AttendanceDetails->delete();
            return response()->json(['deleted' => true]);
        }else{
            return response()->json(['error' => 'Not Found'], 404);
        }
    }
}
