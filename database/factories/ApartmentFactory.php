<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Apartment;
use App\Image;

$factory->define(Apartment::class, function (Faker $faker) {
    $myPict = array("/img/img1.jpg", "/img/img2.jpg","/img/img3.jpg", "/img/img4.jpg","/img/img5.jpg");
    return [
        "description" => $faker -> sentence,
        "rooms" => rand(1,4),
        "beds"=> rand(1,4) ,
        "bathrooms" => rand(1,2),
        "square_feet" => rand(25,100),
        "address" => $faker -> address ,
        "poster_img" => Image::all()-> random() -> path
    ];
});
