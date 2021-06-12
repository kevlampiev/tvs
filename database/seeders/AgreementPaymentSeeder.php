<?php

namespace Database\Seeders;

use App\Models\Agreement;
use DateTime;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgreementPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agreement_payments')->insert($this->getData());
    }

    protected function getData():array
    {
        $faker=Factory::create('ru_RU');
        $data=[];
        $agreements= Agreement::all();
        foreach($agreements as $index=>$agreement) {
            if (($index % 3) !==0) {
                $agreement_id = $agreement->id;
                for ($j=0; $j<36; $j++) {
                    $data[] = [
                        'agreement_id'=>$agreement_id,
                        'payment_date'=>$faker->date(),
                        'amount'=>$faker->numberBetween(100000,5000000),
                        'currency'=>'RUR'
                    ];
                }
            }
        }
        return $data;
    }
}
