<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgreementNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreement_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agreement_id');
            $table->text('note_body')->nullable(false);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        Schema::table('agreement_notes', function (Blueprint $table){
            $table->foreign('agreement_id')->on('agreements')->references('id');
            $table->foreign('user_id')->on('users')->references('id');
        }) ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agreement_notes', function (Blueprint $table){
            $table->dropForeign(['agreement_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('agreement_notes');
    }
}
