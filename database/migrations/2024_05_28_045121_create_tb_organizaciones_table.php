<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbOrganizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_organizaciones', function (Blueprint $table) {
            $table->id();
            $table->boolean('estado')->default(true);
            $table->string('nombre', 255)->nullable(false);
            $table->integer('telefono')->nullable(false);
            $table->string('correo_electronico', 255)->nullable(false);
            $table->string('no_de_cuenta', 255)->nullable(false); // Asumiendo que es un string; ajustar según el tipo de dato requerido
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
        Schema::dropIfExists('tb_organizaciones');
    }
}
