<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class StatisticsService
{
    public function getUserStatistics()
    {
        try {
            $user = Auth::user();
            
            $statistics = [
                'trainings_count' => $user->trainings()->count(),
                'nutrition_plans_count' => $user->nutritionPlans()->count(),
                'progress_logs_count' => $user->progressLogs()->count(),
            ];
            
            return [
                'message' => 'Statistics retrieved successfully',
                'statistics' => $statistics
            ];
        } catch (\Exception $e) {
            Log::error('Error getting user statistics: ' . $e->getMessage());
            throw new \Exception('Error retrieving statistics: ' . $e->getMessage());
        }
    }
} 