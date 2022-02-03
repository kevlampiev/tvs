<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agreement_id')->nullable(false);
            $table->unsignedBigInteger('vehicle_id')->nullable(false);
            $table->date('date_open')->nullable(false);
            $table->date('date_close')->nullable(false);
            $table->date('real_date_close')->nullable(true);
            $table->string('description')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->timestamps();
            $table->foreign('agreement_id')->on('agreements')->references('id');
            $table->foreign('vehicle_id')->on('vehicles')->references('id');
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
        Schema::dropIfExists('deposits');
    }
}
