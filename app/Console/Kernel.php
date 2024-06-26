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
        'App\Console\Commands\SubscriptionCheckTaskCommand',
        'App\Console\Commands\ImageExpirationCheckTaskCommand',
        'App\Console\Commands\RenewCreditsTaskCommand',
        'App\Console\Commands\YookassaSubscriptionTaskCommand',
        'App\Console\Commands\VideoTaskCommand',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('subscription:check')->daily();
        $schedule->command('subscription:renew')->daily();
        $schedule->command('yookassa:check')->daily();
        $schedule->command('checkimage:process')->hourly();
        $schedule->command('video:check')->everyMinute();
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
