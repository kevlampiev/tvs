<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclePlacementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_placements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id')->nullable(false);
            $table->unsignedBigInteger('location_id')->nullable(false);
            $table->date('date_open')->nullable(false);
            $table->text('description')->nullable(true);
            $table->timestamps();
            $table->foreign('vehicle_id')->on('vehicles')->references('id');
            $table->foreign('location_id')->on('vehicle_locations')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_placements');
    }
}
