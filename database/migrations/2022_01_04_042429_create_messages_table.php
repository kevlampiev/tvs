<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->unsignedBigInteger('agreement_id')->nullable(false);
            $table->unsignedBigInteger('vehicle_id')->nullable(false);
            $table->unsignedBigInteger('company_id')->nullable(false);
            $table->unsignedBigInteger('counterparty_id')->nullable(false);
            $table->string('subject')->nullable(false);
            $table->string('description')->nullable(true);
            $table->unsignedBigInteger('reply_to_message_id')->nullable(false);
            $table->timestamps();
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('agreement_id')->on('agreements')->references('id');
            $table->foreign('vehicle_id')->on('vehicles')->references('id');
            $table->foreign('company_id')->on('companies')->references('id');
            $table->foreign('counterparty_id')->on('counterparties')->references('id');
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
            $table->dropForeign(['user_id']);
            $table->dropForeign(['task_performer_id']);
            $table->dropForeign(['agreement_id']);
            $table->dropForeign(['vehicle_id']);
            $table->dropForeign(['company_id']);
            $table->dropForeign(['counterparty_id']);
        });

        Schema::dropIfExists('messages');
    }
}
