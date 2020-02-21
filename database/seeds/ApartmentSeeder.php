<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\Service;
use App\User;
use App\Sponsorship;



class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Apartment::class , 50)
        -> make()
        -> each(function($apartment){

            $user = User::inRandomOrder() -> first();
            $apartment -> user() -> associate($user);

            $apartment -> save();

            $services = Service::inRandomOrder() -> take(rand(0,6)) -> get();
            $apartment -> services() -> attach($services);

            $sponsorships = Sponsorship::inRandomOrder() -> take(rand(0,1)) -> get();
            $start = new DateTime();
            $end = date("Y-m-d H:i:s", time() + 86400);

            $apartment -> sponsorships() -> attach($sponsorships,["start_time" => $start, "end_time" => $end]);
        });
    }
}
