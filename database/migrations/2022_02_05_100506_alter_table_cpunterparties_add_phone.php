<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableCpunterpartiesAddPhone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('counterparties', function(Blueprint $table)
        {
            $table->string('post_adress')->nullable();
            $table->string('header')->nullable()->comment('Имя и должность руководителя');
            $table->string('phone')->nullable()->comment('контактный телефон');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('counterparties', function(Blueprint $table)
        {
            $table->dropColumn('post_adress');
            $table->dropColumn('header')->nullable();
            $table->dropColumn('phone');
        });
    }
}
