<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaCargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // Seeder para la tabla area_cargo
    // Este seeder inserta datos de ejemplo en la tabla area_cargo
    public function run()
    {
        DB::table('area_cargo')->insert([
            [
                'id_area' => 1,
                'id_cargo' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_area' => 1,
                'id_cargo' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_area' => 2,
                'id_cargo' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_area' => 2,
                'id_cargo' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_area' => 3,
                'id_cargo' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
