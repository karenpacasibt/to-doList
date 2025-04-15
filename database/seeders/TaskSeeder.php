<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        [
            [
                'title' => 'Preparar presentación de ventas',
                'description' => 'Preparar diapositivas para la reunión del lunes con el equipo comercial.',
                'status' => true,
                'id_category' => 1,
                'id_user' => 1,
            ],
            [
                'title' => 'Comprar regalos',
                'description' => 'Comprar regalos para el cumpleaños de mamá.',
                'status' => false,
                'id_category' => 2,
                'id_user' => 2,
            ],
            [
                'title' => 'Estudiar SQL',
                'description' => 'Repasar funciones avanzadas de SQL y practicar consultas JOIN.',
                'status' => false,
                'id_category' => 3,
                'id_user' => 3,
            ],
            [
                'title' => 'Ir al médico',
                'description' => 'Chequeo general con el médico de cabecera.',
                'status' => true,
                'id_category' => 4,
                'id_user' => 4,
            ],
            [
                'title' => 'Revisar presupuesto mensual',
                'description' => 'Actualizar gastos en la hoja de cálculo.',
                'status' => false,
                'id_category' => 5,
                'id_user' => 5,
            ],
            [
                'title' => 'Planificar viaje a la playa',
                'description' => 'Buscar alojamiento y transporte.',
                'status' => true,
                'id_category' => 6,
                'id_user' => 6,
            ],
            [
                'title' => 'Reparar lámpara del escritorio',
                'description' => 'Comprar repuesto y reemplazar bombilla.',
                'status' => false,
                'id_category' => 7,
                'id_user' => 7,
            ],
            [
                'title' => 'Aprender Laravel',
                'description' => 'Seguir tutoriales en línea sobre Laravel 10.',
                'status' => true,
                'id_category' => 8,
                'id_user' => 8,
            ],
            [
                'title' => 'Avanzar proyecto personal',
                'description' => 'Diseñar la base de datos del nuevo sistema.',
                'status' => false,
                'id_category' => 9,
                'id_user' => 9,
            ],
            [
                'title' => 'Organizar salida con amigos',
                'description' => 'Definir lugar y hora para juntarse el fin de semana.',
                'status' => true,
                'id_category' => 10,
                'id_user' => 10,
            ],
        ];
        
    }
}
