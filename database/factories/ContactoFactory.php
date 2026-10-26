<?php

namespace Database\Factories;

use App\Models\Contacto;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 *
 */
class ContactoFactory extends Factory
{
    /**
     * Define the model's default state.
    
     */
    public function definition(): array
    {
        return [
            'usuario_id' => Usuario::query()->inRandomOrder()->value('id'),
            'nombre' => fake()->firstName(),
            'apellido' => fake()->lastName(),
            'foto' => fake()->imageUrl($category = 'people'),
            'email' => fake()->unique()->safeEmail(),
            'telefono' => fake()->phoneNumber(),
        ];
    }
}
