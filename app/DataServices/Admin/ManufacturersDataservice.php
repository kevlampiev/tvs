<?php


namespace App\DataServices\Admin;

use App\Models\Manufacturer;

class ManufacturersDataservice
{
    public static function provideData(): array
    {
        return ['manufacturers' => Manufacturer::withCount('vehicles')
            ->orderBy('name')->get(), 'filter' => ''];
    }
}
