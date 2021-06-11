<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAgreementsAddPrincipalamountAndInterestrate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agreements', function(Blueprint $table){
            $table->unsignedDouble('principal_amount')->default(0)->comment('сумма основного долга или рыночная стоимость техники');
            $table->enum('currency', ['RUR', 'USD', 'EUR', 'CNY', 'YPN'])->comment('код валюты');
            $table->float('interest_rate')->default(0)->comment('процентная ставка (для договоров займа и кредитов)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agreements', function(Blueprint $table) {
            $table->dropColumn('principal_amount');
            $table->dropColumn('currency');
            $table->dropColumn('interest_rate');
        });
    }
}
