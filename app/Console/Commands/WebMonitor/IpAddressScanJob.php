<?php

namespace App\Console\Commands\WebMonitor;

use App\Jobs\WebMonitor\IpAddressScanJob as WebMonitorIpAddressScanJob;
use Illuminate\Console\Command;

/**
 * Class IpAddressScanJob.
 */
class IpAddressScanJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'web-monitor:ip-address-scan-job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan IP Address Job.';

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
        WebMonitorIpAddressScanJob::dispatch();

        return 0;
    }
}
