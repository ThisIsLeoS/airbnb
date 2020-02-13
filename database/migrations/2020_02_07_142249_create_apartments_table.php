<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("description");
            $table->unsignedTinyInteger("rooms");
            $table->unsignedTinyInteger("beds")->default(1);
            $table->unsignedTinyInteger("bathrooms")->default(1);
            $table->smallInteger("square_feet");
            $table->string("address");
            $table->decimal("lat", 10, 7);
            $table->decimal("lon", 10, 7);
            // $table->integer("views")->default(0);
            $table->string("poster_img")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
