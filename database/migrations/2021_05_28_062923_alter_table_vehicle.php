<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableVehicle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicles', function(Blueprint $table) {
           $table->unsignedDouble('price')->nullable(true)->defaul(0)->comment('За сколько купили технику');
           $table->date('purchase_date')->nullable(true)->comment('Дата покупки');
           $table->dropColumn('estimate_date');
           $table->dropColumn('market_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicles', function(Blueprint $table) {
            $table->float('market_price')->comment('рыночная стоимость на дату приобретения');
            $table->date('estimate_date')->comment('дата определения рыночной стоимости');
            $table->dropColumn('price');
            $table->dropColumn('purchase_date');
        });
    }
}
