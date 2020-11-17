<?php

namespace App\Jobs\WebMonitor;

use App\Domains\WebMonitor\Models\Monitor;
use App\Domains\WebMonitor\Services\MonitorService;
use Illuminate\Bus\Queueable;
use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IpAddressPingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $container = Container::getInstance();
        $monitorService = $container->make(MonitorService::class);

        foreach (Monitor::whereNotNull('ip_address')->where('active', true)->get() as $monitor) {
            $starttime = microtime(true);
            if ($fsockopen = fsockopen($monitor->ip_address, $monitor->port, $errCode, $errStr, 10)) {
                $stoptime = microtime(true);
                $status = ($stoptime - $starttime) * 1000;
                $status = floor($status);
            } else {
                $status = null;
            }

            if ($monitor->ping != $status) {
                $monitorService->updatePing($monitor, [
                    'ping' => $status,
                ]);
            }
            fclose($fsockopen);
        }
    }
}
