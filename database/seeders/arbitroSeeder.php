<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Arbitro;
class arbitroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Arbitro::create(['primer_nombre'=>'arbitro1' ,'segundo_nombre'=>'nombre2','primer_apellido'=>'apellido' ,'segundo_apellido'=>'apellido','genero'=>'genero','direccion'=>'direccion', 'telefono'=>123456789]);
        
    }
}
