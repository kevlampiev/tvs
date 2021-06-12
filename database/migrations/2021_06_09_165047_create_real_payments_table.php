<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agreement_id');
            $table->date('payment_date')->nullable(false);
            $table->double('amount')->default(0);
            $table->enum('currency', ['RUR', 'USD', 'EUR', 'CNY', 'YPN'])->comment('код валюты');
            $table->text('description')->nullable(true)->comment('Комментарий');
            $table->timestamps();

            $table->foreign('agreement_id')->on('agreements')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_payments');
    }
}
