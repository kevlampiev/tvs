<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('counterparty_id');
            $table->string('agr_number')->default('б/н')->comment('номер договора');
            $table->text('description')->nullable(true)->comment('описание договора');
            $table->date('date_open')->default(today())->comment('Дата договора');
            $table->date('date_close')->nullable(true)->comment('Планируемая дата завершения');
            $table->date('real_date_close')->nullable(true)->comment('Фактическая дата договора');
            $table->string('file_name')->nullable(true)->comment('ссылка на файл');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agreements');
    }
}
