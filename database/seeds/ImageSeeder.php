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
        // crea un'immagine (che avrà come path "sono un immagine")
        // factory(Image::class, 1)->create();
        
        $apartments = Apartment::all();

        $pathImg1 = [
              "path" => "/images/ShowApt/img1.jpg"
            ];
        $pathImg2 = [
              "path" => "/images/ShowApt/img2.jpg"
            ];
        $pathImg3 = [
              "path" => "/images/ShowApt/img3.jpg"
            ];
        $pathImg4 = [
              "path" => "/images/ShowApt/img4.jpg"
            ];
        foreach ($apartments as $apt) {
          $image1 = Image::make($pathImg1);
          $image1 -> apartment() -> associate($apt);
          $image1 -> save();
          $image2 = Image::make($pathImg2);
          $image2 -> apartment() -> associate($apt);
          $image2 -> save();
          $image3 = Image::make($pathImg3);
          $image3 -> apartment() -> associate($apt);
          $image3 -> save();
          $image4 = Image::make($pathImg4);
          $image4 -> apartment() -> associate($apt);
          $image4 -> save();
        }

        // $images = [
        //     ["path" =>'img1'],
        //     ["path" =>'img2'],
        //     ["path" =>'img3'],
        //     ["path" =>'img4']       
        // ];
    
        // foreach($images as $image){
        //   $newImage = new Image;
        //   $newImage -> fill($image) -> save();
        // }
    }
}
