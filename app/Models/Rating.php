<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['workout_id', 'rating'];

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }
}
