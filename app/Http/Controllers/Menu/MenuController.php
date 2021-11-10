<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $Menu = Menu::paginate();
        return response()->json($Menu);
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
            'validity' => 'required',
            'comments' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $Menu = new Menu();
        $Menu->user_id = $request->user_id;
        $Menu->doctor_id = $request->doctor_id;
        $Menu->validity = $request->validity;
        $Menu->comments = $request->comments;
        $Menu->save();
        return response()->json($Menu, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $menuId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($menuId)
    {
        $Menu = Menu::find($menuId);
        if($Menu){
            return response()->json($Menu);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $menuId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $menuId)
    {
        $Menu = Menu::find($menuId);
        if($Menu) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'Required',
                'doctor_id' => 'Required',
                'validity' => 'Required',
                'comments' => 'Required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $Menu->user_id = $request->user_id;
            $Menu->doctor_id = $request->doctor_id;
            $Menu->validity = $request->validity;
            $Menu->comments = $request->comments;
            $Menu->save();
            $Menu->message = 'Updated';
            return response()->json($Menu);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $menuId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($menuId)
    {
        $Menu = Menu::find($menuId);
        if($Menu){
            $Menu->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
