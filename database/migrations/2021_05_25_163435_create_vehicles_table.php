<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vehicle_type_id')->unsigned();
            $table->bigInteger('manufacturer_id')->unsigned();
            $table->string('name')->nullable(false)->unique();
            $table->string('vin')->nullable(false)->comment('Заводской номер/VIN');
            $table->string('bort_number')->nullable(false)->comment('Бортовой номер/Госномер');
            $table->smallInteger('prod_year')->unsigned()->comment('Год выпуска');
            $table->timestamps();
//            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('cascade');
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign(['vehicle_type_id']);
            $table->dropForeign(['manufacturer_type_id']);
//            $table->drop('vehicles');
        });
        Schema::dropIfExists('vehicles');
    }
}
