<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
// Seeder para la tabla locales
    public function run()
    {
        DB::table('locales')->insert([
            [
                'nombre' => 'Oficina Central',
                'direccion' => 'Calle Principal 123, Lima',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Sucursal Norte',
                'direccion' => 'Avenida Norte 456, Trujillo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Sucursal Sur',
                'direccion' => 'Avenida Sur 789, Arequipa',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Sucursal Este',
                'direccion' => 'Calle Este 101, Cusco',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Sucursal Oeste',
                'direccion' => 'Calle Oeste 202, Lima',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
