<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//import namespace
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // yang di koment tidak bisa digunakan karena
        // panggil kelas ArticleFactory untuk mengenerate banyak dummy datanya
        // factory(Article::class, 20)->create();
        Article::factory()->count(20)->create();
        // \App\Models\Article::factory()->count(20)->create();
    }
}
