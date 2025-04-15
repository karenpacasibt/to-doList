<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        [
            ['name' => 'Urgente'],
            ['name' => 'Importante'],
            ['name' => 'Ocio'],
            ['name' => 'Recordatorio'],
            ['name' => 'Trabajo en equipo'],
            ['name' => 'Investigación'],
            ['name' => 'Compras'],
            ['name' => 'Reunión'],
            ['name' => 'Llamada'],
            ['name' => 'Email'],
        ];
    }
}
