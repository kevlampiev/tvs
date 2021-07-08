<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\Type;

class AlterInsurancesAddCurrencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Type::hasType('double')) {
            Type::addType('double', FloatType::class);
        }

        Schema::table('insurances', function(Blueprint $table) {
           $table->string('policy_number')->nullable()->comment('номер страхового полиса');
           $table->enum('amount_currency', ['RUR', 'USD', 'EUR', 'CNY', 'YPN'])
               ->default('RUR')
               ->comment('код валюты страховой суммы');
           $table->enum('premium_currency', ['RUR', 'USD', 'EUR', 'CNY', 'YPN'])
               ->default('RUR')
               ->comment('код валюты страховой премии');
           $table->double('insurance_amount',15,2)->change();
           $table->double('insurance_premium',15,2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurances', function(Blueprint $table) {
            $table->dropColumn('policy_number');
            $table->dropColumn('premium_currency');
            $table->dropColumn('amount_currency');
        });
    }
}
