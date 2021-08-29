<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAgreementsAddUSerId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agreements', function(Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
        });
        Schema::table('agreements', function(Blueprint $table) {
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
        Schema::table('agreements', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('agreements', function(Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
