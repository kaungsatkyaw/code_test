<?php

namespace App\Console\Commands;

use App\Models\BorrowerDetails;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BorrowCheckProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BorrowCheckProcess';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check borrow book';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $existOutOfTimeBooks = BorrowerDetails::where('status', config('constants.BORROW_STATUS.PENDING'))
            ->where('end_date', '<', Carbon::now())
            ->exists();

        if ($existOutOfTimeBooks) {
            BorrowerDetails::where('status', config('constants.BORROW_STATUS.PENDING'))
                ->where('end_date', '<', Carbon::now())
                ->update([
                    'status' => config('constants.BORROW_STATUS.OUT_OF_TIME')
                ]);
        }
    }
}
