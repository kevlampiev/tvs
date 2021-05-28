<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgreementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agreement_types')->insert($this->getData());
        //
    }

    private function getData()
    {
        return [
            ['name' => 'Финансовый лизинг'],
            ['name' => 'Купля продажа'],
            ['name' => 'Купля-продажа с отсрочкой платежа'],
            ['name' => 'Кредит'],
            ['name' => 'Займ'],
            ['name' => 'Залог'],
            ['name' => 'Поручительство'],
        ];
    }
}
