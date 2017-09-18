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
            'Investidor Anjo',
            'Profissional de Imprensa',
            'Universidade',
            'Coworking',
            'Aceleradora',
            'Impacto',
            'Mentor',
            'Corporate',
            'Heroi ou Heroina do Ano',
            'Startup do Ano',
            'Comunidade',
        ];

        $imgs = [
            'aceleradora.png',
            'aceleradora.png',
            'aceleradora.png',
            'aceleradora.png',
            'aceleradora.png',
            'aceleradora.png',
            'aceleradora.png',
            'aceleradora.png',
            'aceleradora.png',
            'aceleradora.png',
            'aceleradora.png',
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
