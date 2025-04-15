<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class TasktagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("tasktags")->insert ([
            ['id_task' => 1, 'id_tag' => 1],
            ['id_task' => 1, 'id_tag' => 2],
            ['id_task' => 2, 'id_tag' => 3],
            ['id_task' => 3, 'id_tag' => 2],
            ['id_task' => 4, 'id_tag' => 4],
            ['id_task' => 5, 'id_tag' => 1],
            ['id_task' => 6, 'id_tag' => 3],
            ['id_task' => 7, 'id_tag' => 5],
            ['id_task' => 8, 'id_tag' => 6],
            ['id_task' => 9, 'id_tag' => 2],
            ['id_task' => 10, 'id_tag' => 3],
            ['id_task' => 10, 'id_tag' => 9],
        ]);
    }
}
