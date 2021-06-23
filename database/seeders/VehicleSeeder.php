<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('vehicles')->insert($this->getData());
    }

    protected function getData(): array
    {
        $faker = Factory::create('ru_RU');
        $data = [];
        for ($i = 0; $i < 30; $i++) {
            $vehicle_type_id = DB::table('vehicle_types')->inRandomOrder()->first()->id;
            $manufacturer_id = DB::table('manufacturers')->inRandomOrder()->first()->id;
            $data[] = [
                'vehicle_type_id' => $vehicle_type_id,
                'manufacturer_id' => $manufacturer_id,
                'name' => $faker->uuid,
                'VIN' => $faker->word(),
                'bort_number' => $faker->numberBetween(100, 900),
                'prod_year' => $faker->numberBetween(1990, 2020),
                'trademark' => $faker->name(),
                'model' => $faker->name(),
                'currency' => 'RUR',
                'price' => $faker->numberBetween(1000000, 100000000),
                'purchase_date' => $faker->date(),
            ];
        }
        return $data;
    }
}
