<?php

namespace Database\Seeders;

use App\Models\Agreement;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgreementNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agreement_notes')->insert($this->getData());
    }

    protected function getData(): array
    {
        $faker = Factory::create('ru_RU');
        $data = [];
        $agreements=Agreement::query()->select('id')->get();

        foreach ($agreements as $agreement) {
            $maxNotesCount = rand(0,10);
            $user = User::query()->inRandomOrder()->first();
            for ($i=0; $i<$maxNotesCount;$i++) {
                $data[] = [
                   'agreement_id' => $agreement->id,
                    'note_body' => $faker->realText(100),
                    'user_id' => $user->id,
                    'created_at' => now()
                ] ;
            }
        }
        return $data;
    }
}
