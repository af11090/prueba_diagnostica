<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cargos')->insert([
            [
                'nombre' => 'Gerente General',
                'descripcion' => 'Responsable de la dirección general de la empresa.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Jefe de Ventas',
                'descripcion' => 'Encargado de liderar el equipo de ventas y alcanzar los objetivos comerciales.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Analista Financiero',
                'descripcion' => 'Responsable del análisis financiero y elaboración de informes económicos.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Especialista en Marketing Digital',
                'descripcion' => 'Encargado de las estrategias de marketing digital y redes sociales.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Coordinador de Recursos Humanos',
                'descripcion' => 'Responsable de la gestión del talento humano y desarrollo organizacional.',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
