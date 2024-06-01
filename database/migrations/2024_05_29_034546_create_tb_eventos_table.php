<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_eventos', function (Blueprint $table) {
            $table->id();
            $table->boolean('estado')->default(true);
            $table->integer('id_categoria')->nullable(false);
            $table->integer('id_deporte')->nullable(false);
            $table->integer('id_patrocinador')->nullable(true);
            $table->integer('id_municipio')->nullable(true);
            $table->string('nombre', 255)->nullable(true);
            $table->string('descripcion', 255)->nullable(true);
            $table->date('fecha_inicio')->nullable(true);
            $table->date('fecha_final')->nullable(true);
            $table->time('hora')->default(true);
            $table->string('equipos_participantes', 255)->nullable(true);
            $table->string('ubicacion')->nullable(true); 
            $table->string('rama', 255)->nullable(true);
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
        Schema::dropIfExists('tb_eventos');
    }
}
