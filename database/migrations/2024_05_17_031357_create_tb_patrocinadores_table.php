<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPatrocinadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_patrocinadores', function (Blueprint $table) {
            $table->id();
            $table-> boolean('estado')->default(true);
            $table->string('primer_nombre', 255)->nullable(false);
            $table->string('segundo_nombre', 255)->nullable(true);
            $table->string('primer_apellido', 255)->nullable(false);
            $table->string('segundo_apellido', 255)->nullable(true);
            $table->integer('telefono')->nullable(true);
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
        Schema::dropIfExists('tb_patrocinadores');
    }
}
