<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsuranceCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('insurance_companies')->insert($this->getData());
    }

    protected function getData():array
    {
        $faker= Factory::create('ru_RU');
        $result = [];
        for ($i=0;$i<10;$i++)
        {
            $result[] = ['name' => $faker->company];
        }
        return $result;
    }
}
