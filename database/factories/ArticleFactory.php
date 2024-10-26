<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // buat ini untuk mengenerate dummy data untuk fakerbuilder
            'user_id' => rand(1,3),
            // "title" => $faker->sentence(4),
            // "body" => $faker->paragraph(2),
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'published' => rand(0,1)
        ];
    }
}
