<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert($this->getData());
    }

    private function getData()
    {
        return [
            ['name' => 'Кузбасс Майнинг ООО' , 'code' => 'КМ'],
            ['name' => 'Горнодобывающая компания Сибирский Угольный Альянс ООО', 'code' => 'СУА'],
            ['name' => 'ТВ-Строй ООО' , 'code' => 'ТВС'],
            ['name' => 'МерПен ООО', 'code' => 'МП'],
            ['name' => 'Синтез-НК ООО', 'code' => 'Синтез'],
            ['name' => 'Сибтэк ООО', 'code' => 'Сибтэк'],
            ['name' => 'Гермес и К ООО', 'code' => 'Гермес'],
        ];
    }
}
