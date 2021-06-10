<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVehiclesForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicles', function(Blueprint $table) {
            $table->dropForeign(['vehicle_type_id']);
            $table->dropForeign(['manufacturer_id']);
        });
        Schema::table('vehicles', function(Blueprint $table) {
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('restrict');
            $table->foreign('vehicle_type_id')->on('vehicle_types')->references('id')->onDelete('restrict');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicles', function(Blueprint $table) {
            $table->dropForeign(['vehicle_type_id']);
            $table->dropForeign(['manufacturer_id']);
        });
        Schema::table('vehicles', function(Blueprint $table) {
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('cascade');
            $table->foreign('vehicle_type_id')->on('vehicle_types')->references('id')->onDelete('cascade');
        });
    }
}
