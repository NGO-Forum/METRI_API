<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'info@ngoforum.org.kh'
            ],
            [
                'name' => 'Admin',
                'password' => Hash::make('@info@NGOF2025'),
                'role' => 'admin',
            ]
        );
    }
}
