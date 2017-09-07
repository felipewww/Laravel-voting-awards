<?php

use Illuminate\Database\Seeder;

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
        $user->name = 'Blanko';
        $user->username =  'blankoadm';
        $user->email = 'felipe@blanko.be';
        $user->password = bcrypt('123123');
        $user->ip = '127.0.0.1';
        $user->type = 'adm';
        $user->agreed = true;

        $user->save();
    }
}
