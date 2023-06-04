<?php

namespace App\Service;

class Pagination
{
    public function paginationWithParam(
        string $modelClass,
        int    $page = 1,
        int    $limit = 6,
        ?array $param = null
    ): array {
        $model = new $modelClass;
        $query = $model->query();
        $query = $this->handleSearch($query, $param['search'] ?? null);

        $offset = ($page - 1) * $limit;
        $totalRecords = $query->count();
        $records = $query->skip($offset)->take($limit)->get();
        $totalPages = ceil($totalRecords / $limit);

        return [
            'result' => $records,
            'page' => $page,
            'perPage' => $limit,
            'total' => $totalRecords,
            'totalPage' => $totalPages
        ];
    }

    private function handleSearch(
        mixed $query,
        ?string $search = null,
    ): mixed {
        if ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('INN', 'LIKE', '%' . $search . '%');
        }

        return $query;
    }
}
