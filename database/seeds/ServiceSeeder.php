<?php

use Illuminate\Database\Seeder;
use App\Service;
use App\Apartment;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Service::class, 6)
        ->create()
        ->each(function($service){

          $apartment = Apartment::inRandomOrder()->take(rand(10,20))->get();

          $service->apartments()->attach($apartment);
        });
    }
}
