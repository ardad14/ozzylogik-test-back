<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PaginationService
{
    public function paginate(Collection $data, int $perPage, int $page = 1): LengthAwarePaginator | Collection
    {
        if ($perPage === 0) {
            return $data;
        }
        $result = $data->forPage($page, $perPage);

        return new LengthAwarePaginator($result, count($data), $perPage);
    }
}
