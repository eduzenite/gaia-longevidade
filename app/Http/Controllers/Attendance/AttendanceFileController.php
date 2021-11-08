<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\AttendanceFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $AttendanceFile = AttendanceFile::paginate();
        return response()->json($AttendanceFile);
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
            'attendance_id' => 'required',
            'files_id' => 'required',
            'type' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $AttendanceFile = new AttendanceFile();
        $AttendanceFile->user_id = $request->user_id;
        $AttendanceFile->attendance_id = $request->attendance_id;
        $AttendanceFile->files_id = $request->files_id;
        $AttendanceFile->type = $request->type;
        $AttendanceFile->save();
        return response()->json($AttendanceFile, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $attendanceId
     * @param  int  $attendanceFileId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($attendanceId, $attendanceFileId)
    {
        $AttendanceFile = AttendanceFile::where('attendance_id', $attendanceId)->find($attendanceFileId);
        if($AttendanceFile){
            return response()->json($AttendanceFile);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $attendanceId
     * @param  int  $attendanceFileId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $attendanceId, $attendanceFileId)
    {
        $AttendanceFile = AttendanceFile::where('attendance_id', $attendanceId)->find($attendanceFileId);
        if($AttendanceFile) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'Required',
                'attendance_id' => 'Required',
                'files_id' => 'Required',
                'type' => 'Required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $AttendanceFile->user_id = $request->user_id;
            $AttendanceFile->attendance_id = $request->attendance_id;
            $AttendanceFile->files_id = $request->files_id;
            $AttendanceFile->type = $request->type;
            $AttendanceFile->save();
            $AttendanceFile->message = 'Updated';
            return response()->json($AttendanceFile);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $attendanceId
     * @param  int  $attendanceFileId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($attendanceId, $attendanceFileId)
    {
        $AttendanceFile = AttendanceFile::where('attendance_id', $attendanceId)->find($attendanceFileId);
        if($AttendanceFile){
            $AttendanceFile->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
