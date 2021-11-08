<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserSpeciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserSpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $UserSpeciality = UserSpeciality::paginate();
        return response()->json($UserSpeciality);
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
            'speciality_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $UserSpeciality = new UserSpeciality();
        $UserSpeciality->user_id = $request->user_id;
        $UserSpeciality->speciality_id = $request->speciality_id;
        $UserSpeciality->save();
        return response()->json($UserSpeciality);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $UserSpeciality = UserSpeciality::find($id);
        if($UserSpeciality){
            return response()->json($UserSpeciality);
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
        $UserSpeciality = UserSpeciality::find($id);
        if($UserSpeciality) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'specialty_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $UserSpeciality->doctor_id = $request->doctor_id;
            $UserSpeciality->user_id = $request->user_id;
            $UserSpeciality->specialty_id = $request->specialty_id;
            $UserSpeciality->save();
            return response()->json(array_merge($UserSpeciality));
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
        $UserSpeciality = UserSpeciality::find($id);
        if($UserSpeciality){
            $UserSpeciality->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
