<?php

namespace App\Http\Controllers\Speciality;

use App\Http\Controllers\Controller;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $Speciality = Speciality::paginate();
        return response()->json($Speciality);
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
            'title' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $Speciality = new Speciality();
        $Speciality->title = $request->title;
        $Speciality->save();
        return response()->json($Speciality, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $specialityId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($specialityId)
    {
        $Speciality = Speciality::find($specialityId);
        if($Speciality){
            return response()->json($Speciality);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $specialityId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $specialityId)
    {
        $Speciality = Speciality::find($specialityId);
        if($Speciality) {
            $validator = Validator::make($request->all(), [
                'title' => 'Required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $Speciality->title = $request->title;
            $Speciality->save();
            $Speciality->message = 'Updated';
            return response()->json($Speciality);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $specialityId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($specialityId)
    {
        $Speciality = Speciality::find($specialityId);
        if($Speciality){
            $Speciality->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
