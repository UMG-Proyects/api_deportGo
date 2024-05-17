<?php

namespace Database\Seeders;

use App\Models\Patrocinador;
use Illuminate\Database\Seeder;

class patrocinadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patrocinador::create(['primer_nombre' => 'Juan', 'segundo_nombre' => 'Carlos', 'primer_apellido' => 'Caal',
    'segundo_apellido' => 'Maaz', 'telefono' => 85203697]);
    }
}
