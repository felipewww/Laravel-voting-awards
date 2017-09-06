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
            'Aceleradora',
            'Assessoria de Imprensa',
            'Assessoria Jurídica',
            'Coworking',
            'Equipe Fundadora',
            'Fundo de Investimento',
            'Investidor Anjo',
            'Melhor comunidade de startups',
            'Melhor universidade para empreendedores',
            'Startup do Ano',
            'Startup do Ano',
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
