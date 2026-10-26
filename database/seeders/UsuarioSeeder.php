<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Database\Factories\UsuarioFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
             // User::factory(10)->create();
        Usuario::factory(5)->create();
    }
}
