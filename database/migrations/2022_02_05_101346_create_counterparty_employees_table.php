<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounterpartyEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counterparty_employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('counterparty_id')->nullable(false);
            $table->string('name')->nullable(false);
            $table->string('title')->nullable(true)->comment('Должность в компании - контрагенте');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('birthday')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(false)->comment('Кто описал данного сотрудника');
            $table->timestamps();
            $table->foreign('counterparty_id')->on('counterparties')->references('id');
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
        Schema::dropIfExists('counterparty_employees');
    }
}
