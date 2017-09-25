<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            'Investidor|Anjo',
            'Profissional|de Imprensa',
            'Universidade',
            'Coworking',
            'Aceleradora',
            'Impacto',
            'Mentor',
            'Corporate',
            'Heroi ou |Heroina do Ano',
            'Startup|do Ano',
            'Comunidade',
        ];

        $imgs = [
            'investidor-anjo.png',
            'profissional-de-imprensa.png',
            'universidade.png',
            'coworking.png',
            'aceleradora.png',
            'impacto.png',
            'mentor.png',
            'corp.png',
            'heroi.png',
            'startup.png',
            'comunidade.png',
        ];

        $i = 0;
        foreach ($arr as $name){
            $cat = new \App\Categories();
            $cat->name = $name;
            $cat->image_name = $imgs[$i];
            $cat->position = $i;

            $cat->save();
            $i++;
        }
    }
}
