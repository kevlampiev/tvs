<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicle_types')->insert($this->getData());
        //
    }

    private function getData()
    {
        return [
            ['name'=>'Экскаватор'],
            ['name'=>'Карьерный самосвал'],
            ['name'=>'Буровая установка'],
            ['name'=>'Бульдозер'],
            ['name'=>'Грейдер'],
            ['name'=>'Автобус'],
            ['name'=>'Легковой а/м'],
            ];
    }
}
