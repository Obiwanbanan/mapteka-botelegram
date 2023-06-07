<?php

namespace App\Service;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Pagination
{
    public function paginationWithParam(
        ?string $modelClass = null,
        Builder $query = null,
        int    $page = 1,
        int    $limit = 6,
    ): array {
        if (!$query) {
            $query = $this->getQueryClass($modelClass);
        }

        $offset = ($page - 1) * $limit;
        $totalRecords = $query->count();
        $records = $query->skip($offset)->take($limit)->get();
        $totalPages = ceil($totalRecords / $limit);

        return [
            $this->getModalName($query->getModel()) => $records,
            'page' => $page,
            'perPage' => $limit,
            'total' => $totalRecords,
            'totalPage' => $totalPages
        ];
    }

    private function getQueryClass(
        string $modelClass,
    ) {
        $model = new $modelClass();

        return $model->query();
    }

    private function getModalName(
        Model $model,
    ): string {

        return sprintf('%ss', mb_strtolower(class_basename($model)));
    }
}
