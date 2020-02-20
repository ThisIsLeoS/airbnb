<?php

use Illuminate\Database\Seeder;
use App\Sponsorship;
use App\Apartment;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $sponsorships = [
        [
          'duration' => '24h',
          'price'=> 2.99
        ],[
          'duration' => '72h',
          'price'=> 5.99
        ],[
          'duration' => '144h',
          'price'=> 9.99
        ],
      ];

      foreach($sponsorships as $sponsorship){
        $newSponsorship = new Sponsorship;
        $newSponsorship-> fill($sponsorship) -> save();
      }

    }
}
