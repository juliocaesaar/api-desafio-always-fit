<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NutritionPlan;

class NutritionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NutritionPlan::create([
            'user_id' => 1,
            'name' => 'Plano de Nutrição',
            'description' => 'Plano de nutrição para aumentar a massa muscular',
            'meal_type' => 'café',
        ]);
    }
}
