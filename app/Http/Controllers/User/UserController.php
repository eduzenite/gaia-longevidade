<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $User = User::paginate();
        return response()->json($User);
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
            'name' => 'required',
            'photo' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'timezone' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $User = new User();
        $User->name = $request->name;
        $User->photo = $request->photo;
        $User->phone = $request->phone;
        $User->email = $request->email;
        $User->password = $request->password;
        $User->role = $request->role;
        $User->timezone = $request->timezone;
        $User->save();
        return response()->json($User);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $User = User::find($id);
        if($User){
            return response()->json($User);
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
        $User = User::find($id);
        if($User) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'photo' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'password' => 'required',
                'role' => 'required',
                'timezone' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $User->doctor_id = $request->doctor_id;
            $User->name = $request->name;
            $User->photo = $request->photo;
            $User->phone = $request->phone;
            $User->email = $request->email;
            $User->password = $request->password;
            $User->role = $request->role;
            $User->timezone = $request->timezone;
            $User->save();
            return response()->json(array_merge($User));
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
        $User = User::find($id);
        if($User){
            $User->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
