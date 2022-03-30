<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePOA extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('power_of_attorneys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable(false);
            $table->string('issued_for')->nullable(false)->comment('на кого выписана доверенность');
            $table->string('poa_number')->comment('номер доверенности');
            $table->string('subject')->nullable(false)->comment('краткое описание');
            $table->text('description')->comment('текст доверенности');
            $table->date('date_open')->default(today());
            $table->date('date_close')->nullale(false);
            $table->unsignedBigInteger('user_id')->nullale(false);
            $table->timestamps();
            $table->foreign('company_id')->on('companies')->references('id');
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
        Schema::dropIfExists('power_of_attorneys');
    }
}
