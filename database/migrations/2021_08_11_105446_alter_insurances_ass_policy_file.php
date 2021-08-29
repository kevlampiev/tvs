<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterInsurancesAssPolicyFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insurances', function(Blueprint $table) {
           $table->string('policy_file')->nullable()->comment('Имя pdf- файла с полисом');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurances', function(Blueprint $table) {
            $table->dropColumn('policy_file');
        });
    }
}
