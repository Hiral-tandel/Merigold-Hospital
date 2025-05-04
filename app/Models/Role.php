<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Helper methods to check role
    public function isAdmin()
    {
        return $this->slug === 'admin';
    }

    public function isDoctor()
    {
        return $this->slug === 'doctor';
    }

    public function isPatient()
    {
        return $this->slug === 'patient';
    }
} 