<?php

use Illuminate\Database\Seeder;

class Finalists10Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $categories = \App\Categories::all();

        foreach ($categories as $cat)
        {
            //Gerar 10 nomes por categoria
            $i = 0;
            while ($i < 10)
            {
                $model = new \App\PreFinalists();
                $model->name = $faker->company;
                $model->categorie_id = $cat->id;
                $model->save();

                $i++;
            }
        }
    }
}
