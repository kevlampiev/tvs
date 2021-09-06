<?php


namespace App\DataServices\Admin;


use App\Models\Counterparty;

class CounterpartiesDataservice
{
    public static function provideData(): array
    {
        return ['counterparties' => Counterparty::withCount('agreements')
            ->orderBy('name')->get(), 'filter' => ''];
    }
}
