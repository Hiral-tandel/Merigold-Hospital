<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'birth',
        'gender',
        'contact',
        'address'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->role->slug === $role;
        }
        return $this->role_id === $role->id;
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isDoctor()
    {
        return $this->hasRole('doctor');
    }

    public function isPatient()
    {
        return $this->hasRole('patient');
    }
}
