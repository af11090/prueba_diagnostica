<?php

use App\Area;
use App\Http\Controllers\TipoContrato;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AreasSeeder::class,
            TiposContratoSeeder::class,
            CargosSeeder::class,
            LocalesSeeder::class,
            LocalAreaSeeder::class,
            AreaCargoSeeder::class,
        ]);
    }
}
