<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyInsurancesAddColumnTaskId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function(Blueprint $table) {
            $table->unsignedBigInteger('task_id')->after('insurance_id')->nullable(true);
        });
        Schema::table('documents', function(Blueprint $table) {
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
        Schema::table('documents', function(Blueprint $table) {
            $table->dropForeign(['task_id']);
        });
        Schema::table('documents', function(Blueprint $table) {
            $table->dropColumn('task_id');
        });

    }
}
