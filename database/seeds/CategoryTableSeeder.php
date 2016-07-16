<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $category = new Category();
        $category->name = "Lyčių santykiai";
        $category->description = "Santuoka, vyrai, moterys, vieni apie kitus ir pan.";
        $category->slug = "lyciu-santykiai";
        $category->save();

        $category = new Category();
        $category->name = "Jausmai";
        $category->description = "Meilė, draugystė, neapykanta, aistra...";
        $category->slug = "jausmai";
        $category->save();

        $category = new Category();
        $category->name = "Gėris ir blogis";
        $category->description = "Moralė, vertybės, ydos, silpnybės...";
        $category->slug = "geris-blogis";
        $category->save();

        $category = new Category();
        $category->name = "Laimė ir kančia";
        $category->description = "Taip pat malonumas bei skausmas.";
        $category->slug = "laime-kancia";
        $category->save();


    }
}
