<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            [
                'nombre' => 'Administración',
                'descripcion' => 'Área encargada de la gestión administrativa de la empresa.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Recursos Humanos',
                'descripcion' => 'Área responsable de la gestión del talento humano.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Finanzas',
                'descripcion' => 'Área encargada de la gestión financiera y contable.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Marketing',
                'descripcion' => 'Área dedicada a la promoción y publicidad de los productos o servicios.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Ventas',
                'descripcion' => 'Área encargada de las ventas y atención al cliente.',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
