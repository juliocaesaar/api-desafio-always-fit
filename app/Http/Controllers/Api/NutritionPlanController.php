<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NutritionPlan;
use App\Http\Requests\StoreNutritionPlanRequest;
use App\Http\Requests\UpdateNutritionPlanRequest;
use App\Services\NutritionPlanService;

class NutritionPlanController extends Controller
{
    protected $nutritionPlanService;

    public function __construct(NutritionPlanService $nutritionPlanService)
    {
        $this->nutritionPlanService = $nutritionPlanService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nutritionPlans = $this->nutritionPlanService->getAll();
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
        $nutritionPlan = $this->nutritionPlanService->create($data);
        return response()->json(['message' => 'Nutrition plan created successfully', 'nutrition_plan' => $nutritionPlan], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $nutritionPlan = $this->nutritionPlanService->getById($id);
        return response()->json(['message' => 'Nutrition plan found successfully', 'nutrition_plan' => $nutritionPlan], 200);
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
        $nutritionPlan = $this->nutritionPlanService->update($id, $request->validated());
        return response()->json(['message' => 'Nutrition plan updated successfully', 'nutrition_plan' => $nutritionPlan], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->nutritionPlanService->delete($id);
        return response()->json($result);
    }
}
