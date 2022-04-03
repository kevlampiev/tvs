<?php

namespace App\DataServices\Admin;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class GlobalSearchDataService
{
    private static function composeSearchStr(string $filter): string
    {
        $words = explode(' ',trim($filter));
        $res = "entity_text LIKE \"%".$words[0]."%\"";
        for ($i=1; $i<count($words);$i++) {
            $res = $res." AND entity_text LIKE \"%".$words[$i]."%\"";
        }
        return $res;
    }

    public static function provideData(string $filter): array
    {
        $filter = ($filter&&$filter!='')?$filter:'%';
        $data = DB::table('v_all_entities_searching_view')
            ->whereRaw(self::composeSearchStr($filter))
            ->paginate(7);
        return ['searchResults' => $data, 'globalSearchStr' => $filter];
    }
}
