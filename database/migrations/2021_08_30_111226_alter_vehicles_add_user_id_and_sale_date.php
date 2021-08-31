<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVehiclesAddUserIdAndSaleDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicles', function(Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('sale_date')->nullable()->comment('ДАта продажи');
        });
        Schema::table('vehicles', function(Blueprint $table) {
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
        Schema::table('vehicles', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('vehicles', function(Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('sale_date');
        });
    }
}
