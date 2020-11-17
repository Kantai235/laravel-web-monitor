<?php

namespace App\Console\Commands\WebMonitor;

use App\Domains\WebMonitor\Models\Monitor;
use App\Domains\WebMonitor\Services\MonitorService;
use Illuminate\Console\Command;

/**
 * Class IpAddressScan.
 */
class IpAddressScan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'web-monitor:ip-address-scan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan IP Address.';

    /**
     * @var MonitorService
     */
    protected $serivce;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(MonitorService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (Monitor::whereNotNull('domain')->where('active', true)->get() as $monitor)
        {
            $ip = getHostByName($monitor->domain);
            if ($monitor->ip_address != $ip)
            {
                $this->service->update($monitor, [
                    'ip_address' => $ip,
                ]);
            }
        }

        return 0;
    }
}
