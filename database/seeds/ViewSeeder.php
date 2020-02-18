<?php

use Illuminate\Database\Seeder;
use App\View;
use App\Apartment;
class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(View::class, 50)

          ->make()
          ->each(function($views){

            $apartment = Apartment::inRandomOrder() -> first();

            $views -> apartment() -> associate($apartment);

            $views -> save();


          });
    }
}
