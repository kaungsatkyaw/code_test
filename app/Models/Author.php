<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the books for the author
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

}
