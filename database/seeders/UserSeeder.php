<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Добавляем одного админа
        DB::table('users')->insert([
            'name' => 'Администратор',
            'email' => 'admin@admin.ru',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
            'created_at' => now(),
            'role'=>'admin'
        ]);
        //Добавляем одного владельца
        DB::table('users')->insert([
            'name' => 'Владелец сервиса',
            'email' => 'owner@owner.ru',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
            'created_at' => now(),
            'role'=>'user'
        ]);
    }
}
