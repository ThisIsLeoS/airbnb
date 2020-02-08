<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Service;

$factory->define(Service::class, function (Faker $faker) {
    $serviceList = [
            'wifi',
            'parking_slot',
            'swimming_pool',
            'sauna',
            'sea_view',
            'reception'
    ];
    return [
        "type" => $faker -> unique() -> randomElement($serviceList)
        /* "wifi" => $faker -> boolean ,
        "parking_slot"=> $faker -> boolean,
        "swimming_pool"=> $faker -> boolean,
        "sauna"=> $faker -> boolean,
        "sea_view"=> $faker -> boolean,
        "reception"=> $faker -> boolean */
    ];
});
