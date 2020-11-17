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

class IpAddressScanJob implements ShouldQueue
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
        $service = $container->make(MonitorService::class);
        foreach (Monitor::whereNotNull('domain')->where('active', true)->get() as $monitor)
        {
            $ip = getHostByName($monitor->domain);
            if ($monitor->ip_address != $ip)
            {
                $service->update($monitor, [
                    'ip_address' => $ip,
                ]);
            }
        }
    }
}
