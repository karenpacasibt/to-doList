<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("categories")->insert([
            
                ['id'=>1,'name' => 'Trabajo'],
                ['id'=>2,'name' => 'Personal'],
                ['id'=>3,'name' => 'Estudios'],
                ['id'=>4,'name' => 'Salud'],
                ['id'=>5,'name' => 'Finanzas'],
                ['id'=>6,'name' => 'Viajes'],
                ['id'=>7,'name' => 'Hogar'],
                ['id'=>8,'name' => 'Tecnología'],
                ['id'=>9,'name' => 'Proyectos'],
                ['id'=>10,'name' => 'Recreación'],
            
        ]);
    }
}
