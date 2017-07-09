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
        $category->name = "Lyčių Santykiai";
        $category->description = "Šeima, santuoka, vyrai, moterys, vieni apie kitus ir pan.";
        $category->slug = "lyciu-santykiai";
        $category->save();

        $category = new Category();
        $category->name = "Jausmai";
        $category->description = "Meilė, draugystė, aistra, neapykanta, abejingumas, vienatvė bei kiti jausmai ar emocijos";
        $category->slug = "jausmai";
        $category->save();

        $category = new Category();
        $category->name = "Protas ir Grožis";
        $category->description = "Logika, mąstymas, išvaizda, temperamentas bei visos žmogiškos savybės";
        $category->slug = "protas-grozis";
        $category->save();

        $category = new Category();
        $category->name = "Gėris ir Blogis";
        $category->description = "Moralė, vertybės ir ydos, laisvė ir karas, tiesa ir melas bei kiti socialiniai ir kultūriniai aspektai";
        $category->slug = "geris-blogis";
        $category->save();

        $category = new Category();
        $category->name = "Laimė ir Kančia";
        $category->description = "Taip pat sveikata ir liga, malonumas ir skausmas, sėkmė ir nesėkmės...";
        $category->slug = "laime-kancia";
        $category->save();

        $category = new Category();
        $category->name = "Mokslas ir Tikėjimas";
        $category->description = "Mokymasis, tobulėjimas, pasiekimai, dvasinės vertybės, religija";
        $category->slug = "mokslas-religija";
        $category->save();

        $category = new Category();
        $category->name = "Menas ir Literatūra";
        $category->description = "Poezija, muzika, dailė, šokis bei kiti menai ar kūryba";
        $category->slug = "menas-literatura";
        $category->save();

        $category = new Category();
        $category->name = "Valdžia ir Pinigai";
        $category->description = "Politika, galia, verslas, darbas, turtas ir skurdas bei visos materialios vertybės";
        $category->slug = "valdzia-pinigai";
        $category->save();

        $category = new Category();
        $category->name = "Gyvenimas ir Mirtis";
        $category->description = "Filosofija, būtis, gyvenimo prasmė, žmogaus prigimtis ir kiti egzistenciniai klausimai";
        $category->slug = "gyvenimas-mirtis";
        $category->save();

        $category = new Category();
        $category->name = "Įvairenybės";
        $category->description = "Patarlės, posakiai, liaudies išmintis ir viskas, kas netiko į kitas kategorijas";
        $category->slug = "ivairenybes";
        $category->save();

    }
}
