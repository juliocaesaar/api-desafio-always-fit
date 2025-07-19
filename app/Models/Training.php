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
        'category',
        'finished'
    ];

    protected $casts = [
        'finished' => 'boolean'
    ];

    public function progressLog()
    {
        return $this->hasOne(ProgressLog::class);
    }

    public function scopeFinished($query)
    {
        return $query->where('finished', true);
    }

    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
