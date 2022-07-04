<?php

namespace App\Http\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

trait CustomPagination
{
    public function customPaginate($items, $perPage = 1, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $current_page = $page;
        $offset = ($current_page * $perPage) - $perPage;
        $item_to_show = array_slice($items, $offset, $perPage);

        return new  LengthAwarePaginator($item_to_show, $total, $perPage);
    }
}
