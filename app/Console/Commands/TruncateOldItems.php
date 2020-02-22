<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;

class TruncateOldItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'items:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete rows in the apartment_sponsorship table where end_time < current time';

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
     * @return mixed
     */
    public function handle()
    {
         DB::table('apartment_sponsorship')
        ->where('end_time', '<', Carbon::now()->toDateTimeString())
        ->each(function ($row) {
            $row->delete();
        });
    }
}
