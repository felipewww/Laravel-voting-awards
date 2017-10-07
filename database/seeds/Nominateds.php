<?php

use Illuminate\Database\Seeder;

class Nominateds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $name = [
            'Blanko',
            'Startup Awards',
            'Microsoft',
            'Google',
            'Apple',
            'Blueberry CA',
            'Naamta',
            'Padaria do Marcão',
            'Big Technologies',
            'Avianca em Revista',
            'AviANCA',
            'AVIANCA revista'
        ];

        $total = (\App\User::all()->count() * 10);
        $i = 0;
        while ($i < $total)
        {
            $userRandom = \App\User::inRandomOrder()->first();
            $cateRandom = \App\Categories::inRandomOrder()->first();

            $nominated              = new \App\Nominateds();

            $nominated->name            = $name[rand(0, count($name)-1)];
            $nominated->reference       = $faker->text(45);
            $nominated->valid           = 0;
            $nominated->user_id         = $userRandom->id;
            $nominated->categorie_id    = $cateRandom->id;

            $nominated->save();

            $i++;
        }
    }
}
