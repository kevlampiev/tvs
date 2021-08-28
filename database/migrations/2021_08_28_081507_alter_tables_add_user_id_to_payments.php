<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablesAddUserIdToPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agreement_payments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
        });
        Schema::table('real_payments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
        });
        Schema::table('agreement_payments', function (Blueprint $table) {
            $table->foreign('user_id')->on('users')->references('id');
        });
        Schema::table('real_payments', function (Blueprint $table) {
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
        Schema::table('agreement_payments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('real_payments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('agreement_payments', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('real_payments', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
