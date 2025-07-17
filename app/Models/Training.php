<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'image_url',
        'level',
        'duration_minutes',
        'exercises',
        'is_active'
    ];

    protected $casts = [
        'exercises' => 'array',
        'is_active' => 'boolean'
    ];

    public function progressLogs()
    {
        return $this->hasMany(ProgressLog::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }
}
