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
     * @param  int  $menuId
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $menuId)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'amount' => 'required',
            'calorie' => 'required',
            'time' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $MenuFood = new MenuFood();
        $MenuFood->menu_id = $menuId;
        $MenuFood->title = $request->title;
        $MenuFood->amount = $request->amount;
        $MenuFood->calorie = $request->calorie;
        $MenuFood->time = $request->time;
        $MenuFood->save();
        return response()->json($MenuFood, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $menuId
     * @param  int  $menuFoodId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($menuId, $menuFoodId)
    {
        $MenuFood = MenuFood::where('menu_id', $menuId)->find($menuFoodId);
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
     * @param  int  $menuId
     * @param  int  $menuFoodId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $menuId, $menuFoodId)
    {
        $MenuFood = MenuFood::where('menu_id', $menuId)->find($menuFoodId);
        if($MenuFood) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'amount' => 'required',
                'calorie' => 'required',
                'time' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $MenuFood->title = $request->title;
            $MenuFood->amount = $request->amount;
            $MenuFood->calorie = $request->calorie;
            $MenuFood->time = $request->time;
            $MenuFood->save();
            $MenuFood->message = 'Updated';
            return response()->json($MenuFood);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $menuId
     * @param  int  $menuFoodId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($menuId, $menuFoodId)
    {
        $MenuFood = MenuFood::where('menu_id', $menuId)->find($menuFoodId);
        if($MenuFood){
            $MenuFood->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
