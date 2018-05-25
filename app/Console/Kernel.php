<?php

namespace App\Console;

use App\Console\Commands\IndexGroupPosts;
use App\Console\Commands\MergeServer;
use App\Console\Commands\PushNotifications;
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
        IndexGroupPosts::class,
        PushNotifications::class,
        MergeServer::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('app:index_group_posts')->everyFiveMinutes();
        $schedule->command('app:push_notifications')->everyTenMinutes();
        $schedule->command('app:merge_server')->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
