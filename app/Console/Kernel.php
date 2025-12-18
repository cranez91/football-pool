<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /*$schedule->command('feed:catalogs')->everyMinute();
        $schedule->command('feed:rounds')->everyMinute();
        $schedule->command('check:winners')->everyMinute();*/

        /*$schedule->command('feed:catalogs')->monthlyOn(1, '5:00');*/
        /*$schedule->command('feed:rounds')->weeklyOn(2, '13:00');*/
        /*$schedule->command('check:winners')->everyFourHours();*/
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
