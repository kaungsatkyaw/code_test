<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BorrowRequest;
use App\Http\Resources\BorrowedBookResource;
use App\Models\BorrowerDetails;
use Carbon\Carbon;
use Illuminate\Http\Response;

class BorrowController extends Controller
{
    /**
     * Borrow a book
     * 
     * @param BorrowRequest $request
     * 
     * @return BorrowedBookResource
     */
    public function borrowBook(BorrowRequest $request)
    {
        $borrowedBooks = BorrowerDetails::create([
            'book_id' => $request->book_id,
            'customer_id' => $request->customer_id,
            'status' => config('constants.BORROW_STATUS.PENDING'),
            'start_date' => Carbon::now()->toDateString(),
            'end_date' => Carbon::now()->addDays($request->borrow_days ?? config('constants.DEFAULT_BORROW_DAY'))->toDateString(),
        ]);

        return (new BorrowedBookResource($borrowedBooks))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Return a book
     * 
     * @param int $bookId
     * 
     * @return BorrowedBookResource
     */
    public function returnBook($bookId)
    {
        $book = BorrowerDetails::where('book_id', $bookId)->first();
        if ($book) {
            $book->update([
                'status' => config('constants.BORROW_STATUS.RETURNED'),
                'actual_return_time' => Carbon::now(),
            ]);
        }

        return response()->json([
            'message' => 'returned successfully',
        ], Response::HTTP_ACCEPTED);
    }
}
