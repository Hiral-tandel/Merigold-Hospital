<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Get the admin role
        $adminRole = Role::where('slug', 'admin')->first();

        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@hospital.com',
            'password' => Hash::make('admin123'),
            'role_id' => $adminRole->id,
        ]);
    }
} 