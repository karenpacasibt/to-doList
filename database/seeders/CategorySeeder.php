<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {[
        ['name' => 'Trabajo'],
        ['name' => 'Personal'],
        ['name' => 'Estudios'],
        ['name' => 'Salud'],
        ['name' => 'Finanzas'],
        ['name' => 'Viajes'],
        ['name' => 'Hogar'],
        ['name' => 'Tecnología'],
        ['name' => 'Proyectos'],
        ['name' => 'Recreación'],
    ];}
}
