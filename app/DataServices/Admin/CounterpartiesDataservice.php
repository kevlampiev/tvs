<?php


namespace App\DataServices\Admin;


use App\Models\Counterparty;
use Illuminate\Http\Request;


class CounterpartiesDataservice
{

    public static function getAll()
    {
        return Counterparty::withCount('agreements')
            ->orderBy('name')->get();
    }


    public static function getFiltered(string $filter)
    {
        $searchStr = '%' . str_replace(' ', '%', $filter) . '%';
        return Counterparty::withCount('agreements')
            ->where('name','like',$searchStr)
            ->orderBy('name')->get();
    }


    public static function index(Request $request): array
    {
        $filter = ($request->get('searchStr')) ?? '';
        if ($filter === '') $counterparties = self::getAll();
        else $counterparties = self::getFiltered($filter);
        return ['counterparties' => $counterparties, 'filter' => $filter];
    }
}
