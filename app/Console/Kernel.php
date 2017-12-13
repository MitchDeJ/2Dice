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
        $schedule->command('stocks:update')->hourly();

        //updating quicksell prices
        $schedule->command('prices:update')->dailyAt('00:00');
        $schedule->command('prices:update')->dailyAt('06:00');
        $schedule->command('prices:update')->dailyAt('12:00');
        $schedule->command('prices:update')->dailyAt('18:00');

        //paying salaries

        $schedule->command('salaries:pay')->daily();
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
