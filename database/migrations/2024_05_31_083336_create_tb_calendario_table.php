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
            $table->integer('id_arbitro')->nullable(false);
            $table->integer('id_equipo')->nullable(false);
            $table->integer('id_deportes')->nullable(true);
            $table->date('fecha')->nullable(false);
            $table->time('hora')->default('12:00:00');
            $table->string('direccion',255)->nullable(false);
            $table->integer('resultadoA')->nullable(false);
            $table->integer('resultadoB')->nullable(false);
            $table->string('Cancha',255)->nullable(false);
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
