<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('trademark')->comment('марка (HITACHI)');
            $table->string('model')->comment('модель (типа EX1250)');
            $table->float('market_price')->comment('рыночная стоимость на дату приобретения');
            $table->enum('currency', ['RUR', 'USD', 'EUR', 'CNY', 'YPN'])->comment('код валюты');
            $table->date('estimate_date')->comment('дата определения рыночной стоимости');
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
            $table->dropColumn('trademark');
            $table->dropColumn('model');
            $table->dropColumn('model');
            $table->dropColumn('market_price');
            $table->dropColumn('currency');
            $table->dropColumn('estimate_date');
        });
    }
}
