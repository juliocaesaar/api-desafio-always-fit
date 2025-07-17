<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TrainingController;
use App\Http\Controllers\Api\NutritionPlanController;
use App\Http\Controllers\Api\ProgressLogController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/refresh-token', [AuthController::class, 'refreshToken']);
    Route::get('/me', [UserController::class, 'me']);
    Route::put('/user/{id}', [UserController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('trainings', TrainingController::class);
    Route::apiResource('nutrition-plans', NutritionPlanController::class);
    Route::apiResource('progress-logs', ProgressLogController::class);
});
