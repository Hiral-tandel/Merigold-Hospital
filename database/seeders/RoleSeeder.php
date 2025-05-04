<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Administrator',
                'slug' => 'admin'
            ],
            [
                'name' => 'Doctor',
                'slug' => 'doctor'
            ],
            [
                'name' => 'Patient',
                'slug' => 'patient'
            ]
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['slug' => $role['slug']], $role);
        }
    }
} 