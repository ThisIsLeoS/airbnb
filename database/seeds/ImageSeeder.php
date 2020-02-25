<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Image::class, 100)

          ->make()
          ->each(function($image){

            $apartment = Apartment::inRandomOrder() -> first();

            $image -> apartment() -> associate($apartment);

            $image -> save();


          });
    }
}
