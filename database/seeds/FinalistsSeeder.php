<?php

use Illuminate\Database\Seeder;

class FinalistsSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $categories = \App\Categories::all();

        foreach ($categories as $cat)
        {
            //Gerar 3 nomes por categoria
            $i = 0;
            while ($i < 3)
            {
                $model = new \App\Finalists();
                $model->name = $faker->company;
                $model->categorie_id = $cat->id;
                $model->save();

                $i++;
            }
        }
    }
}
