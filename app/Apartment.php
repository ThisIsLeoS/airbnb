<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        "title",
        "description",
        "rooms",
        "beds",
        "bathrooms",
        "square_feet",
        "address",
        "lat",
        "lon",
        "poster_img"

    ];

    public function services(){
        return $this -> belongsToMany(Service::class);
    }

    public function user(){
        return $this -> belongsTo(User::class);
    }

     public function views(){
        return $this -> hasMany(View::class);
    }

    public function images(){
        return $this -> hasMany(Image::class);
    }

    public function messages(){
        return $this -> hasMany(Message::class);
    }
}
