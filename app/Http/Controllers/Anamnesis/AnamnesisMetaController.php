<?php

namespace App\Http\Controllers\Anamnesis;

use App\Http\Controllers\Controller;
use App\Models\AnamnesisMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnamnesisMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $AnamnesisMeta = AnamnesisMeta::paginate();
        return response()->json($AnamnesisMeta);
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
            'anamnesis_id' => 'required',
            'meta' => 'required',
            'value' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $AnamnesisMeta = new AnamnesisMeta();
        $AnamnesisMeta->anamnesis_id = $request->anamnesis_id;
        $AnamnesisMeta->meta = $request->meta;
        $AnamnesisMeta->value = $request->value;
        $AnamnesisMeta->save();
        return response()->json($AnamnesisMeta, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $anamnesisId
     * @param  int  $anamnesisMetaId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($anamnesisId, $anamnesisMetaId)
    {
        $AnamnesisMeta = AnamnesisMeta::where('anamnesis_id', $anamnesisId)->find($anamnesisMetaId);
        if($AnamnesisMeta){
            return response()->json($AnamnesisMeta);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $anamnesisId
     * @param  int  $anamnesisMetaId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $anamnesisId, $anamnesisMetaId)
    {
        $AnamnesisMeta = AnamnesisMeta::where('anamnesis_id', $anamnesisId)->find($anamnesisMetaId);
        if($AnamnesisMeta) {
            $validator = Validator::make($request->all(), [
                'anamnesis_id' => 'Required',
                'meta' => 'Required',
                'value' => 'Required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $AnamnesisMeta->anamnesis_id = $request->anamnesis_id;
            $AnamnesisMeta->meta = $request->meta;
            $AnamnesisMeta->value = $request->value;
            $AnamnesisMeta->save();
            $AnamnesisMeta->message = 'Updated';
            return response()->json($AnamnesisMeta);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $anamnesisId
     * @param  int  $anamnesisMetaId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($anamnesisId, $anamnesisMetaId)
    {
        $AnamnesisMeta = AnamnesisMeta::where('anamnesis_id', $anamnesisId)->find($anamnesisMetaId);
        if($AnamnesisMeta){
            $AnamnesisMeta->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
