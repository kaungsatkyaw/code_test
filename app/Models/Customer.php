<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends BaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_no',
        'name',
        'address',
        'phone',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            $customer->customer_no = self::generateCustomerNumber();
        });
    }

    private static function generateCustomerNumber()
    {
        $prefix = 'CUS';
        $nextNumber = self::max('id') + 1;

        $formattedNumber = str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
        return $prefix . $formattedNumber;
    }
}
