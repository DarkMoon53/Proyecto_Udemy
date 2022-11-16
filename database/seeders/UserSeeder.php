<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            [
                "name" => "admin",
                "email" => "admin@admin.com",
                "password" => bcrypt("admin"),
                "apellido" => "admin",
                "Dirección" => "admin",
                "telefono" => "123456789",
                "remember_token" => Str::random(10),
                "role_id" => 1,
            ]
        ]);
    }
}
