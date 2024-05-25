<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Municipio;

class MunicipioSeeder extends Seeder
{
    public function run()
    {
        Municipio::create(['municipio'=>'Municipio Ejemplo','departamento'=>'Departamento Ejemplo']);
    }
}
