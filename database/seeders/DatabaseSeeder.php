<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call([
           UserSeeder::class,
           AgreementTypeSeeder::class,
           CompanySeeder::class,
           CounterpartySeeder::class,
           ManufacturerSeeder::class,
           VehicleTypeSeeder::class,
           AgreementTypeSeeder::class,
           VehicleSeeder::class,
       ]);
    }
}
