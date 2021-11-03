<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id')->nullable(false);
            $table->string('comment')->nullable();
            $table->string('img_file')->nullable();
            $table->timestamps();
        });

        Schema::table('vehicle_photos', function (Blueprint $table) {
            $table->foreign('vehicle_id')->on('vehicles')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicle_photos', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
        });
        Schema::dropIfExists('vehicle_photos');
    }
}
