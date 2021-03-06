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
        $services = [
            ["type" =>'wifi'],
            ["type" =>'posto auto'],
            ["type" =>'piscina'],
            ["type" =>'sauna'],
            ["type" =>'vista mare'],
            ["type" =>'reception']
        ];
    
        foreach($services as $service){
          $newService = new Service;
          $newService -> fill($service) -> save();
        }
    }
}
