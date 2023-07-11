<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\FeedingCatalogs;
use Illuminate\Support\Facades\Log;

class FeedCatalogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:catalogs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Requests to RapidApi for getting countries, leagues and teams';

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
        Log::info('dispatching FeedingCatalogs.');
        FeedingCatalogs::dispatch();
    }
}
