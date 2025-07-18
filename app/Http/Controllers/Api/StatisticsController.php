<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    /**
     * Get user statistics
     */
    public function index()
    {
        $user = Auth::user();

        $statistics = [
            'trainings_count' => $user->trainings()->count(),
            'nutrition_plans_count' => $user->nutritionPlans()->count(),
            'progress_logs_count' => $user->progressLogs()->count(),
        ];

        return response()->json($statistics);
    }
} 