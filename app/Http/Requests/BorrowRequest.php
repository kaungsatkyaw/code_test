<?php

namespace App\Http\Requests;

use App\Models\Book;
use App\Models\BorrowerDetails;
use App\Models\Customer;
use Illuminate\Validation\Rule;

class BorrowRequest extends ApiFormBaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'book_id' => 'required|integer|' . Rule::in(Book::all()->pluck('id')) . '|' . 
                Rule::notIn(BorrowerDetails::where('book_id', request('book_id'))
                    ->whereIn('status', [
                        config('constants.BORROW_STATUS.PENDING'),
                        config('constants.BORROW_STATUS.OUT_OF_TIME'),
                    ])
                    ->pluck('book_id')
                ),
            'customer_id' => 'required|integer|' . Rule::in(Customer::all()->pluck('id')),
            'borrow_days' => 'integer',
        ];
    }
}
