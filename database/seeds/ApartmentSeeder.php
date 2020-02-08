<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\Service;
use App\User;



class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Apartment::class , 51) 
        -> make() 
        -> each(function($apartment){

            $user = User::inRandomOrder() -> first();
            $apartment -> user() -> associate($user);
            
            $apartment -> save();
        });
    }
}
