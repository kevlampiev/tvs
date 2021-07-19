<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankStatementPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_statement_positions', function (Blueprint $table) {
            $table->id();
            $table->date('date_open');
            $table->string('payer')->comment('Наименование плательщика');
            $table->string('payer_inn',12)->comment('инн плательщика');
            $table->string('receiver')->comment('Получатель платежа');
            $table->string('receiver_inn',12)->comment('инн получателя платежа');
            $table->double('amount')->comment('Сумма платежа');
            $table->string('description')->comment('Основание платежа');
            $table->unsignedBigInteger('agreement_id')->nullable()->comment('ссылка на договор');
            $table->unsignedBigInteger('user_id')->comment('ссылка на пользователя, создавшего запись');
            $table->timestamps();
        });

        Schema::table('companies', function(Blueprint $table) {
            $table->string('inn', 12)->nullable();
        });

        Schema::table('counterparties', function(Blueprint $table) {
            $table->string('inn', 12)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_statement_positions');

        Schema::table('companies', function(Blueprint $table) {
            $table->dropColumn('inn');
        });

        Schema::table('counterparties', function(Blueprint $table) {
            $table->dropColumn('inn');
        });
    }
}
