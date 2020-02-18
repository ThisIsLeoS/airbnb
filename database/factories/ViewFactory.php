<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\View;

$factory->define(View::class, function (Faker $faker) {
    return [
        "ip_address" => $faker -> sentence
    ];
});
