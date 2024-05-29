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
        $table->integer('id_patrocinador')->nullable(false);
        $table->integer('id_municipio')->nullable(false);
        $table->integer('participantes')->nullable(false);
        $table->string('nombre', 255)->nullable(false);
        $table->string('descripcion', 255);
        $table->date('fecha_inicio')->nullable(false);
        $table->date('fecha_final')->nullable();
        $table->time('hora')->default('00:00:00');
        $table->string('equipos_participantes', 255);
        $table->string('ubicacion')->nullable(); // Permitir valores nulos
        $table->string('rama', 255)->nullable(false);
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