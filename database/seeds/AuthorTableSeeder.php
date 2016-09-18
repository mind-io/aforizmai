<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Author;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = new Author();
        $author->name = "Albert Camus";
        $author->slug = "albert-camus";
        $category->save();

        $author = new Author();
        $author->name = "Friedrich Nietzsche";
        $author->slug = "friedrich-nietzsche";
        $category->save();

        
    }
}
