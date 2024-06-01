<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbEquipoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_equipo', function (Blueprint $table) {
            $table->id();
            $table->boolean('estado')->default(true);
            $table->integer('id_deporte')->nullable(false);
            $table->integer('id_categoria')->nullable(true);
            $table->integer('id_municipio')->nullable(true);
            $table->string('nombre');
            $table->integer('participantes');
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
        Schema::dropIfExists('tb_equipo');
    }
}
