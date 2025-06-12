<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creación de la tabla local_area
        Schema::create('local_area', function (Blueprint $table) {
            $table->foreignId('id_local')->constrained('locales');
            $table->foreignId('id_area')->constrained('areas');
            $table->primary(['id_local', 'id_area']);
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
        Schema::dropIfExists('local_area');
    }
}
