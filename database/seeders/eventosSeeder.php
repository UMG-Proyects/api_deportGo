<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\eventos;

class eventosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        eventos::create(['id_categoria' => 1,'id_deporte' => 1,'id_patrocinador' => 1,'id_municipio' => 1,'nombre' => 'nombre1','descripcion' => 'descripcion','fecha_inicio' => '2024-05-12','fecha_final' => '2024-05-12','equipos_participantes' => 'equipo1', 'ubicacion' => 'Estadio Municipal','rama' => 'rama1']);

    }
}
