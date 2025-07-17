<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NutritionPlan;
use App\Http\Requests\StoreNutritionPlanRequest;
use App\Http\Requests\UpdateNutritionPlanRequest;

class NutritionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nutritionPlans = NutritionPlan::all();
        return response()->json($nutritionPlans);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNutritionPlanRequest $request)
    {
        $data = $request->validated();
        $nutritionPlan = NutritionPlan::create($data);
        return response()->json($nutritionPlan, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $nutritionPlan = NutritionPlan::findOrFail($id);
        return response()->json($nutritionPlan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNutritionPlanRequest $request, string $id)
    {
        $nutritionPlan = NutritionPlan::findOrFail($id);
        $nutritionPlan->update($request->validated());
        return response()->json($nutritionPlan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
