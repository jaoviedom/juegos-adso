<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'rol' => 'Administrador',
            'password' => Hash::make('admin'),
        ]);
        DB::table('users')->insert([
            'name' => 'Jose Oviedo',
            'email' => 'jaoviedom@gmail.com',
            'rol' => 'Instructor',
            'password' => Hash::make('12345678'),
        ]);
        
        DB::table('grupos')->insert([
            'nombre' => 'Sin grupo',
            'user_id' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'Mateo',
            'email' => 'mateo@gmail.com',
            'rol' => 'Aprendiz',
            'password' => Hash::make('12345678'),
        ]);
        DB::table('aprendizs')->insert([
            'nombre' => 'Mateo',
            'email' => 'mateo@gmail.com',
            'grupo_id' => '1',
        ]);
        DB::table('users')->insert([
            'name' => 'Marcos',
            'email' => 'marcos@gmail.com',
            'rol' => 'Aprendiz',
            'password' => Hash::make('12345678'),
        ]);
        DB::table('aprendizs')->insert([
            'nombre' => 'Marcos',
            'email' => 'marcos@gmail.com',
            'grupo_id' => '1',
        ]);
        DB::table('users')->insert([
            'name' => 'Lucas',
            'email' => 'lucas@gmail.com',
            'rol' => 'Aprendiz',
            'password' => Hash::make('12345678'),
        ]);
        DB::table('aprendizs')->insert([
            'nombre' => 'Lucas',
            'email' => 'lucas@gmail.com',
            'grupo_id' => '1',
        ]);
        DB::table('users')->insert([
            'name' => 'Juan',
            'email' => 'juan@gmail.com',
            'rol' => 'Aprendiz',
            'password' => Hash::make('12345678'),
        ]);
        DB::table('aprendizs')->insert([
            'nombre' => 'Juan',
            'email' => 'juan@gmail.com',
            'grupo_id' => '1',
        ]);
    }
}
