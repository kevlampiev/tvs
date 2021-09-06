<?php


namespace App\DataServices\Admin;


use App\Models\AgreementType;

class AgreementTypesDataservice
{
    public static function provideData(): array
    {
        return ['agrTypes' => AgreementType::withCount('agreements')->orderBy('name')->get(), 'filter' => ''];
    }
}
