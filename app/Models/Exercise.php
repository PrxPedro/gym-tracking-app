<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

   // Exercise.php
    protected $fillable = ['name', 'last_set_intensity', 'technique', 'warm_up_sets', 'working_sets', 'set_1', 'set_2', 'set_3', 'substitution_option_1', 'notes'];

    
    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }
}
