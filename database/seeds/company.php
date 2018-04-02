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


  $factory->define(App\Models\company::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'image' => $faker->image,
        'phones' => $faker->phones,
        'description' => $faker->description,
        'popular' => 0,
        'website_company' => $faker->website_company,
        'facebook_page' => $faker->facebook_page,
        'city' => $faker->city,
        'area' => $faker->area,
        'ownerid' => rand(10,30),
        'company_code' => rand(10,30),
        'categoryid' => rand(10,30),
    ]; });



    }
}
