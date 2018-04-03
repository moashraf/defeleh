<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class company extends Seeder
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
        App\Models\company::create([
             'name' => $faker->company  ,
        'address' => $faker->address,
        'image' => $faker->image,
        'phones' => $faker->e164PhoneNumber     ,
        'description' => $faker->text(100)  ,
         'popular' => 0,
         'website_company' => $faker->url ,
         'facebook_page' => $faker->url,
       'city' => $faker->city,
        'area' => $faker->streetName,
        'ownerid' => rand(10,30),
        'company_code' => rand(1000,3000),
        'categoryid' => rand(10,30)
        ]);
    }



  



    }
}
