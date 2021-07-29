<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVehiclesAddPtsImgPAth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicles', function(Blueprint $table) {
            $table->string('pts_img_path')->nullable()->comment('путь к изображениюПТС/ПСМ');
            $table->text('description')->nullable()->comment('свободное описание');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicles', function(Blueprint $table) {
            $table->dropColumn('pts_img_path');
            $table->dropColumn('description');
        });
    }
}
