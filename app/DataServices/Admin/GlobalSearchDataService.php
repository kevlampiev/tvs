<?php

namespace App\DataServices\Admin;

use Illuminate\Support\Facades\DB;

class GlobalSearchDataService
{
    public static function provideData(string $filter): array
    {
        $searchString ='%'.str_replace(' ','%', $filter).'%';
        $data = collect(DB::select('SELECT * from v_all_entities_searching_view where entity_text like ?',[$searchString]));
        return ['searchResults' => $data, 'globalSearchStr' => $filter];
    }
}
