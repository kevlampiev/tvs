<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgreementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agreements')->insert($this->getData());
    }

    protected function getData():array
    {
        $faker= Factory::create('ru_RU');
        $data = [];
        for($i=0; $i<30;$i++) {
            $company_id = DB::table('companies')->inRandomOrder()->first()->id;
            $counterparty_id = DB::table('counterparties')->inRandomOrder()->first()->id;
            $agreement_type_id = DB::table('agreement_types')->inRandomOrder()->first()->id;
            $data[] =[
                'name'=> $faker->word(),
                'company_id' => $company_id,
                'counterparty_id' => $counterparty_id,
                'agr_number'=>$faker->word(),
                'description'=>$faker->realText(80),
                'date_open'=>$faker->date(),
                'date_close'=>$faker->date(),
                'agreement_type_id'=>$agreement_type_id
            ];
        }
        return $data;
    }
}
