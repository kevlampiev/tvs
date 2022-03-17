<?php

namespace App\DataServices\Admin;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class GlobalSearchDataService
{
    public static function provideData(string $filter): array
    {
        $searchString ='%'.str_replace(' ','%', $filter).'%';
        $data = DB::table('v_all_entities_searching_view')
            ->where('entity_text','like', $searchString)
            ->paginate(7);
        return ['searchResults' => $data, 'globalSearchStr' => $filter];
    }
}
