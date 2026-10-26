<?php

namespace Database\Seeders;

use App\Models\Contacto;
use Database\Factories\ContactoFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contacto::factory(30)->create();
    }
}
