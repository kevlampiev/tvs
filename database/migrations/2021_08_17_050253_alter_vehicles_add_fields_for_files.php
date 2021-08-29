<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVehiclesAddFieldsForFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicles', function(Blueprint $table) {
            $table->string('img_file')->nullable()->comment('Общее изображение');
            $table->string('pts_file')->nullable()->comment('Файл с ПТС/ПСМ ');
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
            $table->dropColumn('img_file');
            $table->dropColumn('pts_file');
        });
    }
}
