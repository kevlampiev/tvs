<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuaranteeIndividualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guarantee_individuals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agreement_id')->nullable(false);
            $table->unsignedBigInteger('guarantor_id')->nullable(false);
            $table->date('date_open')->nullable(false);
            $table->date('date_close')->nullable(false);
            $table->date('real_date_close')->nullable(false);
            $table->string('description')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->timestamps();
            $table->foreign('agreement_id')->on('agreements')->references('id');
            $table->foreign('guarantor_id')->on('users')->references('id');
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
        Schema::dropIfExists('guarantee_individuals');
    }
}
