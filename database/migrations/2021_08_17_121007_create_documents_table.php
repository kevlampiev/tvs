<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->unsignedBigInteger('agreement_id')->nullable();
            $table->unsignedBigInteger('insurance_id')->nullable();
            $table->string('file_name')->nullable(false);
            $table->string('description',255)->nullable(false);
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->timestamps();
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->foreign('vehicle_id')->on('vehicles')->references('id');
            $table->foreign('agreement_id')->on('agreements')->references('id');
            $table->foreign('insurance_id')->on('insurances')->references('id');
            $table->foreign('user_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
