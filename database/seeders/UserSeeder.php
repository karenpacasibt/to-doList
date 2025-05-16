<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table("users")->insert([
            [
                'name' => 'Romina Pacasi',
                'email' => 'romina@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Ana Gómez',
                'email' => 'ana@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Carlos Ruiz',
                'email' => 'carlos@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Lucía Méndez',
                'email' => 'lucia@example.com',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
