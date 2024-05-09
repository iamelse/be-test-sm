<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $adminRole = Role::create([
            'name' => 'Admin'
        ]);
        
        $validatorRole = Role::create([
            'name' => 'Validator'
        ]);

        Role::create([
            'name' => 'Driver'
        ]);
        
        $lanaUser = User::create([
            'name' => 'Lana',
            'last_name' => 'Septiana',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'role_id' => $adminRole->id
        ]);
        
        $tatangUser = User::create([
            'name' => 'Tatang',
            'last_name' => 'Basher',
            'email' => 'validator@gmail.com',
            'password' => 'password',
            'role_id' => $validatorRole->id
        ]);

        User::factory(100)->create();
        Vehicle::factory(50)->create();
    }
}
