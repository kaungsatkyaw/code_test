<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function scopeCustomFilter(Builder $query)
    {
        return $query->when(request()->title, function ($query) {
            return $query->where('title', 'like', '%' . trim(request()->title) . '%');
        });
    }

    public function scopePagination(Builder $query)
    {
        return $query->paginate(request('limit', 10));
    }
}
