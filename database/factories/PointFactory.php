<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Point;
use Faker\Generator as Faker;

$factory->define(Point::class, function (Faker $faker) {
    return [
        'lng'=> $faker->longitude(-63.5, -63.7), 
        'lat'=> $faker->latitude(44.5, 44.7), 
        'type'=> $faker->randomElement(['Feature','Maintenance','Asset','Projects']) ,
        'categories_id'=>$faker->randomdigit(), 
        'title'=>$faker->sentence(8), 
        'description'=>$faker->realText(150)
    ];
});
