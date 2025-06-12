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
    // Seeder para la base de datos
    // Este seeder llama a otros seeders para poblar las tablas de la base de datos
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
