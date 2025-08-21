<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        $admin = User::create([
            'name' => 'System Administrator',
            'first_name' => 'System',
            'last_name' => 'Administrator',
            'email' => 'admin@alphasecurity.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'phone' => '+1-555-0001',
            'is_active' => true,
        ]);
        $admin->assignRole('admin');

        // Create sample officer
        $officer = User::create([
            'name' => 'John Officer',
            'first_name' => 'John',
            'last_name' => 'Officer',
            'email' => 'officer@alphasecurity.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'phone' => '+1-555-0002',
            'is_active' => true,
        ]);
        $officer->assignRole('officer');

        // Create sample homeowner
        $homeowner = User::create([
            'name' => 'Jane Homeowner',
            'first_name' => 'Jane',
            'last_name' => 'Homeowner',
            'email' => 'homeowner@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'phone' => '+1-555-0003',
            'address' => '123 Main Street',
            'city' => 'Anytown',
            'state' => 'CA',
            'zip_code' => '12345',
            'is_active' => true,
        ]);
        $homeowner->assignRole('homeowner');
    }
}