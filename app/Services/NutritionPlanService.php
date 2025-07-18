<?php

namespace App\Services;

use App\Models\NutritionPlan;
use Illuminate\Support\Facades\Log;
use App\Exceptions\NutritionPlanNotFoundException;
use App\Exceptions\UnauthorizedAccessException;
use Illuminate\Support\Facades\Auth;

class NutritionPlanService
{
    public function getAll()
    {
        try {
            $user = Auth::user();
            return $user->nutritionPlans;
        } catch (\Exception $e) {
            Log::error('Error getting all nutrition plans: ' . $e->getMessage());
            throw new NutritionPlanNotFoundException();
        }
    }

    public function create(array $data)
    {
        try {
            $user = Auth::user();
            $data['user_id'] = $user->id;
            $nutritionPlan = NutritionPlan::create($data);
            return $nutritionPlan;
        } catch (\Exception $e) {
            Log::error('Error creating nutrition plan: ' . $e->getMessage());
            throw new \Exception('Error creating nutrition plan: ' . $e->getMessage());
        }
    }

    public function getById(string $id)
    {
        try {
            $user = Auth::user();
            $nutritionPlan = $user->nutritionPlans()->findOrFail($id);
            return $nutritionPlan;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Error getting nutrition plan by id: ' . $e->getMessage());
            throw new NutritionPlanNotFoundException($id);
        } catch (\Exception $e) {
            Log::error('Error getting nutrition plan by id: ' . $e->getMessage());
            throw new NutritionPlanNotFoundException($id);
        }
    }

    public function update(string $id, array $data)
    {
        try {
            $user = Auth::user();
            $nutritionPlan = $user->nutritionPlans()->findOrFail($id);
            $nutritionPlan->update($data);
            return $nutritionPlan;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Error updating nutrition plan: ' . $e->getMessage());
            throw new NutritionPlanNotFoundException($id);
        } catch (\Exception $e) {
            Log::error('Error updating nutrition plan: ' . $e->getMessage());
            throw new NutritionPlanNotFoundException($id);
        }
    }

    public function delete(string $id)
    {
        try {
            $user = Auth::user();
            $nutritionPlan = $user->nutritionPlans()->findOrFail($id);
            $nutritionPlan->delete();
            return ['message' => 'Nutrition plan deleted successfully'];
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Error deleting nutrition plan: ' . $e->getMessage());
            throw new NutritionPlanNotFoundException($id);
        } catch (\Exception $e) {
            Log::error('Error deleting nutrition plan: ' . $e->getMessage());
            throw new NutritionPlanNotFoundException($id);
        }
    }
} 