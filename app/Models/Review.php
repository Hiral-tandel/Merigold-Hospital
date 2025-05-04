<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'rating',
        'comment',
        'status'
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    protected $casts = [
        'rating' => 'integer',
    ];
}
