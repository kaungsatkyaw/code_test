<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class BorrowerDetails extends BaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'book_id',
        'status',
        'start_date',
        'end_date',
        'actual_return_time',
    ];
}
