<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Municipios;

class municipiosSeeder extends Seeder
{
    public function run()
    {
        Municipios::create(['municipio'=>'Municipio Ejemplo','departamento'=>'Departamento Ejemplo']);
    }
}
