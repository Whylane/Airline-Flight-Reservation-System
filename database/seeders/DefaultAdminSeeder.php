<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Sample',
            'last_name' => 'Superadmin',
            'email' => 'afrs02642@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
        ]);
        
        // User::create([
        //     'first_name' => 'Sample',
        //     'last_name' => 'Admin',
        //     'email' => 'afrs02642@gmail.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'admin',
        // ]);
    }
}
