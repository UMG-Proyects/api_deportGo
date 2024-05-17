<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\categoria;
class categoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        categoria::create(['categoria'=>'categoria1']);
    }
}
