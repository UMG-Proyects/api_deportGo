<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbCalendarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_calendario', function (Blueprint $table) {
            $table->id();
            $table->boolean('estado')->default(true);
            $table->integer('id_arbitro')->nullable(true);
            $table->string('id_equipo1')->nullable(false);
              $table->string('id_equipo2')->nullable(false);
            $table->integer('id_deportes')->nullable(true);
            $table->date('fecha')->nullable(true);
            $table->time('hora')->default(true);
            $table->string('direccion',255)->nullable(true);
            $table->integer('resultadoA')->nullable(true);
            $table->integer('resultadoB')->nullable(true);
            $table->string('Cancha',255)->nullable(true);
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
        Schema::dropIfExists('tb_calendario');
    }
}
