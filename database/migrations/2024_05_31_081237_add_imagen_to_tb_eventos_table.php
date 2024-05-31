<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagenToTbEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_eventos', function (Blueprint $table) {
            $table->string('imagen', 255)->nullable(true)->after('rama');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_eventos', function (Blueprint $table) {
            $table->dropColumn('imagen');
        });
    }
}
