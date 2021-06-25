<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAgreements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agreements', function (Blueprint $table) {
            $table->unsignedBigInteger('agreement_type_id');
            $table->foreign('agreement_type_id')->on('agreement_types')->references('id');
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
        Schema::table('agreements', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['counterparty_id']);
            $table->dropForeign(['agreement_type_id']);
            $table->dropColumn('agreement_type_id');
        });
    }
}
