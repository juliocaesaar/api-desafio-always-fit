<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'weight',
        'height',
        'gender',
        'activity_level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'weight' => 'decimal:2',
        'height' => 'decimal:2'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function nutritionPlans()
    {
        return $this->hasMany(NutritionPlan::class);
    }

    public function progressLogs()
    {
        return $this->hasMany(ProgressLog::class);
    }


    public function getBmiAttribute()
    {
        if ($this->weight && $this->height) {
            return round($this->weight / ($this->height * $this->height), 2);
        }
        return null;
    }

    public function progressLogsInRange($startDate, $endDate)
    {
        return $this->progressLogs()->inDateRange($startDate, $endDate);
    }
}
