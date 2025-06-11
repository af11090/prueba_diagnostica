<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposContratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table('tipos_contrato')->insert([
            [
                'nombre' => 'Indefinido',
                'descripcion' => 'Contrato sin fecha de finalización definida.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Temporal',
                'descripcion' => 'Contrato con fecha de finalización definida.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Por Obra',
                'descripcion' => 'Contrato por la duración de una obra específica.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Prácticas',
                'descripcion' => 'Contrato para estudiantes en prácticas profesionales.',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
