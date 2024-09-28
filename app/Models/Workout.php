<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category', 'description'];

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }
}
