<?php


namespace App\DataServices\Admin;


use App\Models\Counterparty;

class CounterpartyEmployeesDataservice
{
    public static function provideEditor(CounterpartyEmployee $employee): array
    {
        return ['employye' => $employee];
    }
}
