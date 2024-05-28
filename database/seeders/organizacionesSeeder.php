<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organizaciones; 

class OrganizacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creando una organización de ejemplo
        Organizaciones::create([
            'nombre' => 'Organización Deportiva', 
            'estado' => true, 
            'telefono' => 12345678, 
            'correo_electronico' => 'contacto@organizaciondeportiva.com', 
            'no_de_cuenta' => '1234567890'
        ]);
    }
}
