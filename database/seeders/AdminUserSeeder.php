<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Administrateur',
            'email' => 'admin@gstock.ci',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);

        $user->assignRole('admin');
    }
}
