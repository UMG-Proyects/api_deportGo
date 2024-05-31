<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParticipantesToTbEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_eventos', function (Blueprint $table) {
            $table->string('participantes')->nullable()->after('id_municipio');
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
            $table->dropColumn('participantes');
        });
    }
}
