<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table -> bigInteger("user_id")->unsigned()->index();
            $table -> foreign("user_id","user_apartment_id")
            ->references("id")
            ->on("users");

        });

          Schema::table('apartment_service', function (Blueprint $table) {
            $table -> bigInteger("apartment_id")->unsigned()->index();
            $table -> foreign("apartment_id","apartment_service_apartment_id")
            ->references("id")
            ->on("apartments");

            $table -> bigInteger("service_id")->unsigned()->index();
            $table -> foreign("service_id","apartment_service_service_id")
            ->references("id")
            ->on("services");
        });
        
        Schema::table('messages', function (Blueprint $table) {
            $table -> bigInteger("apartment_id")->unsigned()->index();
            $table -> foreign("apartment_id","apartment_message_id")->references("id")->on("apartments");
        });

        Schema::table('images', function (Blueprint $table) {
            $table -> bigInteger("apartment_id")->unsigned()->index();
            $table -> foreign("apartment_id","apartment_images_id")->references("id")->on("apartments");
        });

          Schema::table('views', function (Blueprint $table) {
            $table -> bigInteger('apartment_id') -> unsigned() -> index();
            $table -> foreign('apartment_id', 'views_apartments_id')
                   -> references('id')
                   -> on('apartments');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apartment_service', function (Blueprint $table) {
            $table->dropForeign("apartment_service_apartment_id");
            $table->dropColumn("apartment_id");
            
            $table->dropForeign("apartment_service_service_id");
            $table->dropColumn("service_id");
        });

         Schema::table('apartments', function (Blueprint $table) {
            $table -> dropForeign("user_apartment_id");
            $table -> dropColumn("user_id");

        });
         Schema::table('messages', function (Blueprint $table) {
            $table -> dropForeign("apartment_message_id");
            $table -> dropColumn("apartment_id");

        });
         Schema::table('images', function (Blueprint $table) {
            $table -> dropForeign("apartment_images_id");
            $table -> dropColumn("apartment_id");

        });

         Schema::table('views', function (Blueprint $table) {
              $table -> dropForeign('views_apartments_id');
              $table -> dropColumn('apartment_id');
        });

    }
}
