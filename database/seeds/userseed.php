<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class userseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



$faker = Faker\Factory::create();

    for($i = 0; $i < 5; $i++) {
        App\User::create([
        'name' => $faker->name  ,
        'email' => $faker->email,
        'password' => bcrypt(123456),
        'user_role' => 0,
        'api_token' =>  str_random(25),
         'activate' => 0,
         'social_id' => 0,
         'user_name' => $faker->name ,
        ]);
    }


   



    }
}
