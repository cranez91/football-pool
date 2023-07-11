<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\CheckingWinners;
use Illuminate\Support\Facades\Log;

class CheckWinners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:winners';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Close active matchday and set winners';

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
        Log::info('dispatching CheckWinners.');
        CheckingWinners::dispatch();
    }
}
