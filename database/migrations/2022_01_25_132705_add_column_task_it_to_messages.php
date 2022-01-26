<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTaskItToMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->unsignedBigInteger('task_id')->nullable()->after('user_id');
            $table->unsignedBigInteger('agreement_id')->nullable()->change();
            $table->string('subject')->nullable()->change();
            $table->unsignedBigInteger('vehicle_id')->nullable()->change();
            $table->unsignedBigInteger('company_id')->nullable()->change();
            $table->unsignedBigInteger('counterparty_id')->nullable()->change();
            $table->unsignedBigInteger('reply_to_message_id')->nullable()->change();
            $table->mediumText('description')->nullable(false)->change();
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('task_id')->on('tasks')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['task_id']);

        });
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('task_id');
        });
    }
}
