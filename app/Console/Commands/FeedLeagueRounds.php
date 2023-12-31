<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\FeedingLeagueRounds;
use Illuminate\Support\Facades\Log;

class FeedLeagueRounds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:rounds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Requests to RapidApi for getting league rounds and games';

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
        Log::info('dispatching FeedingLeagueRounds.');
        FeedingLeagueRounds::dispatch();
    }
}
