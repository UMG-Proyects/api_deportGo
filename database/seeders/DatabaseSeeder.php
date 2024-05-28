<?php

namespace Database\Seeders;

use App\Models\Municipio;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            arbitroSeeder::class,
            categoriaSeeder::class,
            deporteSeeder::class,
            patrocinadorSeeder::class,
            municipiosSeeder::class,
        ]);
    }
}
