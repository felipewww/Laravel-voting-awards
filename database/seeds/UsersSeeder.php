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
        $faker = \Faker\Factory::create();
        $ips = [];

        $ix = 0;
        while ($ix < 30)
        {
            array_push($ips, $faker->ipv4);
            $ix++;
        }

        $i = 0;
        while ($i < 10){
            $user = new \App\User();
            $user->name     = $faker->name;
            $user->email    = $faker->email;
            $user->password = bcrypt('123123');
            $user->type     = 'usr';
            $user->ip       = $ips[rand(0,count($ips))];
            $user->agreed   = true;

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
