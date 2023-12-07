<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends BaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author_id',
    ];

    /**
     * Get the author of the book
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function borrowed()
    {
        return $this->hasOne(BorrowerDetails::class);
    }
}
