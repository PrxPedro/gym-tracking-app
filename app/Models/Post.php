<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Add 'user_id' to allow mass assignment
    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id', // Add this line
    ];

    // Define relationships (optional)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

