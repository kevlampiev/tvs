<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CounterpartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('counterparties')->insert($this->getData());
    }

    private function getData()
    {
        return [
            ['name' => 'ТрансФин-М ПАО'],
            ['name' => 'Siemens Fimance'],
            ['name' => 'РЕСО-Лизинг ООО'],
            ['name' => 'Дельта-лизинг'],
            ['name' => 'Сбербанк Среднерусский'],
            ['name' => 'Сбербанк Сибирский'],
            ['name' => 'Кузбасс Бизнес Банк'],
        ];
    }
}
