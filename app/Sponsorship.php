<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
  protected $fillable = [
    'duration',
    'price'
  ];

  public function apartments(){
      return $this -> belongsToMany(Apartment::class) -> withPivot("start_time", "end_time");
  }
}
