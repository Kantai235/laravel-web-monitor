<?php

namespace App\Console;

use App\Models\Crons;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel.
 */
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\WebMonitor\IpAddressPing::class,
        \App\Console\Commands\WebMonitor\IpAddressScan::class,
        // \App\Console\Commands\WebMonitor\IpAddressPingJob::class,
        // \App\Console\Commands\WebMonitor\IpAddressScanJob::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /**
         * 掛載排程 `worker` 去執行
         */
        $schedule->command('web-monitor:ip-address-scan')->everyMinute()->when(function () {
            return Crons::everySomeMinutes('web-monitor:ip-address-scan', 10);
        });
        $schedule->command('web-monitor:ip-address-ping')->everyMinute()->when(function () {
            return Crons::everySomeMinutes('web-monitor:ip-address-ping', 1);
        });

        /**
         * 掛載 `worker` 並以任務(Job)的形式去執行
         */
        // $schedule->command('web-monitor:ip-address-scan-job')->everyMinute()->when(function () {
        //     return Crons::everySomeMinutes('web-monitor:ip-address-scan-job', 10);
        // });
        // $schedule->command('web-monitor:ip-address-ping-job')->everyMinute()->when(function () {
        //     return Crons::everySomeMinutes('web-monitor:ip-address-ping-job', 1);
        // });

        /**
         * Crons Example:
         */
        // $schedule->command('command')->everyMinute()->when(function () {
        //     return Crons::everySomeMinutes('command', 10);
        // });
        // $schedule->command('command')->everyMinute()->when(function () {
        //     return Crons::dailyAt('command', 'time');
        // });
        // $schedule->command('command')->everyMinute()->when(function () {
        //     return Crons::weeklyAt('command', 'days', 'time');
        // });
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
