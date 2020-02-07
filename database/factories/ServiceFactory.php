<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        "wifi" => $faker -> boolean ,
        "parking_slot"=> $faker -> boolean,
        "swimming_pool"=> $faker -> boolean,
        "sauna"=> $faker -> boolean,
        "sea_view"=> $faker -> boolean,
        "reception"=> $faker -> boolean
    ];
});
