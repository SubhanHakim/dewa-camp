<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Buat user biasa
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'), // Ganti dengan password yang diinginkan
            'role' => 'user', // Set role sebagai 'user'
        ]);

        // Buat admin (opsional)
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Ganti dengan password yang diinginkan
            'role' => 'admin', // Set role sebagai 'admin'
        ]);
    }
}