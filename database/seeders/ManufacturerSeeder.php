<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('manufacturers')->insert($this->getData());
        //
    }

    private function getData()
    {
        return [
            ['name' => 'Komatsu'],
            ['name' => 'Mitsubishi'],
            ['name' => 'Atlas'],
            ['name' => 'John Deere'],
            ['name' => 'Caterpillar'],
            ['name' => 'Белаз'],
            ['name' => 'МАЗ'],
        ];
    }
}
