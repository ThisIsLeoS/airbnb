<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Image;

$factory->define(Image::class, function (Faker $faker) {
    return [
        "path" =>  "sono un immagine"
    ];
});
