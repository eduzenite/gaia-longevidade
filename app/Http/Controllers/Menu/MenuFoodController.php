<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\MenuFood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuFoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $MenuFood = MenuFood::paginate();
        return response()->json($MenuFood);
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
            'menu_id' => 'required',
            'title' => 'required',
            'amount' => 'required',
            'calorie' => 'required',
            'time' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $MenuFood = new MenuFood();
        $MenuFood->menu_id = $request->menu_id;
        $MenuFood->title = $request->title;
        $MenuFood->amount = $request->amount;
        $MenuFood->calorie = $request->calorie;
        $MenuFood->time = $request->time;
        $MenuFood->save();
        return response()->json($MenuFood);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $MenuFood = MenuFood::find($id);
        if($MenuFood){
            return response()->json($MenuFood);
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
        $MenuFood = MenuFood::find($id);
        if($MenuFood) {
            $validator = Validator::make($request->all(), [
                'menu_id' => 'required',
                'title' => 'required',
                'amount' => 'required',
                'calorie' => 'required',
                'time' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $MenuFood->doctor_id = $request->doctor_id;
            $MenuFood->menu_id = $request->menu_id;
            $MenuFood->title = $request->title;
            $MenuFood->amount = $request->amount;
            $MenuFood->calorie = $request->calorie;
            $MenuFood->time = $request->time;
            $MenuFood->save();
            return response()->json(array_merge($MenuFood));
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
        $MenuFood = MenuFood::find($id);
        if($MenuFood){
            $MenuFood->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
