<?php

namespace App\Console\Commands\WebMonitor;

use App\Domains\WebMonitor\Models\Monitor;
use App\Domains\WebMonitor\Services\MonitorService;
use Illuminate\Console\Command;

/**
 * Class IpAddressPing.
 */
class IpAddressPing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'web-monitor:ip-address-ping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ping IP Address.';

    /**
     * @var MonitorService
     */
    protected $monitorService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(MonitorService $monitorService)
    {
        parent::__construct();

        $this->monitorService = $monitorService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
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
                $this->monitorService->updatePing($monitor, [
                    'ping' => $status,
                ]);
            }
            fclose($fsockopen);
        }

        return 0;
    }
}
