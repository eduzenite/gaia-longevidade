<?php

namespace App\Http\Controllers\Prescription;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $Medicine = Medicine::paginate();
        return response()->json($Medicine);
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
            'prescription_id' => 'required',
            'title' => 'required',
            'dosage' => 'required',
            'schedules' => 'required',
            'quantity' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $Medicine = new Medicine();
        $Medicine->prescription_id = $request->prescription_id;
        $Medicine->title = $request->title;
        $Medicine->dosage = $request->dosage;
        $Medicine->schedules = $request->schedules;
        $Medicine->quantity = $request->quantity;
        $Medicine->save();
        return response()->json($Medicine);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $prescriptionId
     * @param  int  $prescriptionMedicineId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($prescriptionId, $prescriptionMedicineId)
    {
        $Medicine = Medicine::where('prescription_id', $prescriptionId)->find($prescriptionMedicineId);
        if($Medicine){
            return response()->json($Medicine);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $prescriptionId
     * @param  int  $prescriptionMedicineId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $prescriptionId, $prescriptionMedicineId)
    {
        $Medicine = Medicine::where('prescription_id', $prescriptionId)->find($prescriptionMedicineId);
        if($Medicine) {
            $validator = Validator::make($request->all(), [
                'prescription_id' => 'required',
                'title' => 'required',
                'dosage' => 'required',
                'schedules' => 'required',
                'quantity' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $Medicine->prescription_id = $request->prescription_id;
            $Medicine->title = $request->title;
            $Medicine->dosage = $request->dosage;
            $Medicine->schedules = $request->schedules;
            $Medicine->quantity = $request->quantity;
            $Medicine->save();
            return response()->json(array_merge($Medicine));
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $prescriptionId
     * @param  int  $prescriptionMedicineId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($prescriptionId, $prescriptionMedicineId)
    {
        $Medicine = Medicine::where('prescription_id', $prescriptionId)->find($prescriptionMedicineId);
        if($Medicine){
            $Medicine->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
