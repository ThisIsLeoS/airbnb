<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Apartment;
use App\Image;

$factory->define(Apartment::class, function (Faker $faker) {
    
    return [
        "title" => $faker -> company,
        "description" => $faker -> sentence,
        "rooms" => rand(1,4),
        "beds"=> rand(1,4) ,
        "bathrooms" => rand(1,2),
        "square_feet" => rand(25,100),
        "address" => $faker -> address ,
        // 'views'=>rand(10, 1000) ,
        'lat'=> $faker-> latitude($min = 40, $max = 70),
        'lon'=> $faker-> longitude($min = 0, $max = 60),
        "poster_img" => "https://source.unsplash.com/random/1920x1280/?apartment"
    ];
});
