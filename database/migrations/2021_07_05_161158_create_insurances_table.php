<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('insurance_company_id');
            $table->unsignedBigInteger('insurance_type_id');
            $table->date('date_open')->nullable(false);
            $table->date('date_close')->nullable(false);
            $table->float('insurance_amount')->nullable(false);
            $table->float('insurance_premium')->nullable(false);
            $table->text('description');
            $table->timestamps();


        });

        Schema::table('insurances', function(Blueprint $table) {
            $table->foreign('vehicle_id')->on('vehicles')->references('id');
            $table->foreign('insurance_company_id')->on('insurance_companies')->references('id');
            $table->foreign('insurance_type_id')->on('insurance_types')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurances', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
            $table->dropForeign(['insurance_type_id']);
            $table->dropForeign(['insurance_company_id']);
        });
        Schema::dropIfExists('insurances');
    }
}
