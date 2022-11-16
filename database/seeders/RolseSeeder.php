<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("roles")->insert([
            ["Nombre" => "admin", "Descripción" => "administrador"],
            ["Nombre" => "profesor", "Descripción" => "profesor"],
            ["Nombre" => "alumno", "Descripción" => "alumno"],
        ]);
    }
}
