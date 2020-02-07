<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Service extends Model
{
     protected $fillable = [

        "wifi",
        "parking_slot",
        "swimming_pool",
        "sauna",
        "sea_view",
        "reception"

    ];

    public function apartments(){
        return $this -> belongsToMany(Apartment::class);
    }
}
