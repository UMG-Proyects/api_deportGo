<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Calendario;
class calendarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        calendario::create(['id_arbitro' => 1,'id_deporte' => 1,'fecha' => '2024-05-12', 'direccion' => 'Estadio Municipal']);

    }
}
