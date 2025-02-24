<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Super Admin (You)
        User::create([
            'name' => 'Super Admin',
            'email' => 'hasimtanderjawala@gmail.com',
            'password' => Hash::make('masjid$H751'), // Change this!
            'role' => 'super_admin',
        ]);
    }
}