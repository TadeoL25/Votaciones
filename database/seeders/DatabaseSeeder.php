<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('Hola'),
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'name' => 'Votante',
            'email' => 'votante@votante.com',
            'password' => Hash::make('Hola'),
            'role' => 'votante',
        ]);

        \App\Models\candidato::create([
            'nombre' => 'Candidato',
            'telefono' => '1234567890',
            'direccion' => 'Calle 123',
            'votos' => 0,
        ]);
    }
}
