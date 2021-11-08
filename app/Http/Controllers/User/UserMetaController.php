<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $UserMeta = UserMeta::paginate();
        return response()->json($UserMeta);
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
            'meta' => 'required',
            'value' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $UserMeta = new UserMeta();
        $UserMeta->user_id = $request->user_id;
        $UserMeta->meta = $request->meta;
        $UserMeta->value = $request->value;
        $UserMeta->save();
        return response()->json($UserMeta);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $UserMeta = UserMeta::find($id);
        if($UserMeta){
            return response()->json($UserMeta);
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
        $UserMeta = UserMeta::find($id);
        if($UserMeta) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'meta' => 'required',
                'value' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $UserMeta->doctor_id = $request->doctor_id;
            $UserMeta->user_id = $request->user_id;
            $UserMeta->meta = $request->meta;
            $UserMeta->value = $request->value;
            $UserMeta->save();
            return response()->json(array_merge($UserMeta));
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
        $UserMeta = UserMeta::find($id);
        if($UserMeta){
            $UserMeta->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
