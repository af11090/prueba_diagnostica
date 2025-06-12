<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaCargo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creación de la tabla area_cargo
        Schema::create('area_cargo', function (Blueprint $table) {
            $table->foreignId('id_area')->constrained('areas');
            $table->foreignId('id_cargo')->constrained('cargos');
            $table->primary(['id_area', 'id_cargo']);
            $table->timestamps(4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_cargo');
    }
}
