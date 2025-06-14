<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creación de la tabla contrato
        Schema::create('contrato', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_empleado')->constrained('empleados');
            $table->foreignId('id_tipo_contrato')->constrained('tipos_contrato');
            $table->foreignId('id_cargo')->constrained('cargos');
            $table->foreignId('id_area')->constrained('areas');
            $table->foreignId('id_local')->constrained('locales');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
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
        Schema::dropIfExists('contrato');
    }
}
