<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbInscripcionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_inscripcion', function (Blueprint $table) {
            $table->id();
            $table->boolean('estado')->default(true);
            $table->integer('id_equipo')->nullable(true);
            $table->integer('id_evento')->nullable(false);
            $table->string('nombre',255)->nullable(false);
            $table->integer('edad');
            $table->string('genero',255);
            $table->integer('telefono')->nullable(false);
            $table->integer('telefono_emergencia');
            $table->string('nombre_entrenador',255)->nullable(false);
            $table->integer('tarifa')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_inscripcion');
    }
}