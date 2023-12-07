<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * filter data
     * 
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param array $columns
     *
     * @return $query
     */
    public function scopeCustomFilter(Builder $query, $columns)
    {
        foreach ($columns as $column) {
            $query = $query->when(request()->$column, function ($query) use ($column) {
                    return $query->where($column, 'like', '%' . trim(request()->$column) . '%');
                });
        }
        return $query;
    }

    /**
     * paginate
     * 
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return $query
     */
    public function scopePagination(Builder $query)
    {
        return $query->paginate(request('limit', 10));
    }
}
