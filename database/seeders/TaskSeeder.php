<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert($this->getFirstWaveData());
        for ($i=0; $i<3; $i++) {
            DB::table('tasks')->insert($this->getSecondWaveData());
        }
    }

    private function getFirstWaveData()
    {
        $faker = Factory::create('ru_RU');
        $result = [];
        $users = User::query()->where('role','<>','user')->get();
        foreach($users as $user) {
            $result[] = [
                'user_id' => $user->id,
                'task_performer_id' => $user->id,
                'start_date' => now(),
                'due_date' => Carbon::now()->addDays(10),
                'subject' => $faker->realText(50),
                'description' =>$faker->realText(250),

            ];
        }
        return $result;
    }

    private function getSecondWaveData()
    {
        $result = [];
        $tasks = Task::all();
        $faker = Factory::create('ru_RU');
        $user = User::query()->inRandomOrder()->first();

        foreach($tasks as $task) {
            $maxcount = rand(0, 5);
            for($i=0; $i<$maxcount; $i++) {
                $result[] = [
                    'user_id' => $user->id,
                    'task_performer_id' => $user->id,
                    'start_date' => now(),
                    'due_date' => Carbon::now()->addDays(10),
                    'subject' => $faker->realText(50),
                    'description' =>$faker->realText(250),
                    'parent_task_id' => $task->id,
                ];

            }
        }

        return $result;
    }
}
