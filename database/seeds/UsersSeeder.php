<?php

use Illuminate\Database\Seeder;
//use Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [];
        $faker = \Faker\Factory::create();
//        dd($faker->email);
//
//        $f = new Faker\Factory();
//        $f = new Faker\Factory();
        $i = 0;
        while ($i < 10){
            $user = new \App\User();
            $user->name = $faker->name;
            $user->email = $faker->email;
            $user->password = bcrypt('123123');
            $user->type = 'usr';
            $user->ip = '127.0.0.1';
            $user->agreed = true;

            $user->save();

            $i++;
        }

        $user = new \App\User();
        $user->name = 'Felipe Admin';
        $user->email = 'felipe@blanko.be';
        $user->password = bcrypt('123123');
        $user->ip = '127.0.0.1';
        $user->type = 'adm';
        $user->agreed = true;

        $user->save();
    }
}
