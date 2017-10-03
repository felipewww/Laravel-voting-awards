<?php

use Illuminate\Database\Seeder;

class WinnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $categories = \App\Categories::orderBy('position')->get();

        foreach ($categories as $cat)
        {
            $model                  = new \App\Winners();
            $model->name            = $faker->company;
            $model->categorie_id    = $cat->id;
            $model->votes           = 10;
            $model->save();
        }
    }
}
