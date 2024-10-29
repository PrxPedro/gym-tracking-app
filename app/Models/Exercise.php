<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sets',
        'reps',
        'video_url', 
    ];
    
    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }
}
