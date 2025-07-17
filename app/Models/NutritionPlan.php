<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'meal_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeByMealType($query, $mealType)
    {
        return $query->where('meal_type', $mealType);
    }
}
