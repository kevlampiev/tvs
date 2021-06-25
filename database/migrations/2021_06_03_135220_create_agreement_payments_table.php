<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgreementPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreement_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agreement_id');
            $table->date('payment_date')->nullable(false);
            $table->double('amount')->default(0);
            $table->enum('currency', ['RUR', 'USD', 'EUR', 'CNY', 'YPN'])->comment('код валюты');
            $table->date('canceled_date')->nullable(true)->comment('если принят новый график платежей, старый отменяется в дату canceled_date');
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
        Schema::dropIfExists('agreement_payments');
    }
}
