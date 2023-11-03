<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->text(10),
            'description' => fake()->text(20),
            'text' => fake()->text(30),
        ];
    }
}
