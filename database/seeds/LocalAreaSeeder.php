<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('local_area')->insert([
            [
                'id_local' => 1,
                'id_area' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_local' => 1,
                'id_area' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_local' => 2,
                'id_area' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_local' => 2,
                'id_area' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_local' => 3,
                'id_area' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
