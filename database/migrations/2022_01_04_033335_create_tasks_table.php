<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(false)->comment('постановщик задачи');
            $table->unsignedBigInteger('task_performer_id')->nullable(false)
                ->comment('исполнитель задачи');
            $table->dateTime('start_date')->nullable(false)->comment('дата начала');
            $table->dateTime('due_date')->nullable(false)
                ->comment('плановая дата окончания');
            $table->dateTime('terminate_date')->nullable(false)
                ->comment('дата реального окончания');
            $table->enum('terminate_status', ['complete', 'cancel'])
                ->nullable(true)->comment('статус закрытия');
            $table->string('subject')->nullable(false)
                ->comment('название задачи');
            $table->text('description');
            $table->unsignedBigInteger('parent_task_id');
            $table->unsignedBigInteger('agreement_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('counterparty_id');
            $table->enum('importance',['low', 'medium', 'high'])->default('medium');
            $table->unsignedBigInteger('previous_id');
            $table->timestamps();
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('task_performer_id')->on('users')->references('id');
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
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['task_performer_id']);
            $table->dropForeign(['agreement_id']);
            $table->dropForeign(['vehicle_id']);
            $table->dropForeign(['company_id']);
            $table->dropForeign(['counterparty_id']);
        });

        Schema::dropIfExists('tasks');
    }
}
