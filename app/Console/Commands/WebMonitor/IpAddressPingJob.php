<?php

namespace App\Console\Commands\WebMonitor;

use App\Jobs\WebMonitor\IpAddressPingJob as WebMonitorIpAddressPingJob;
use Illuminate\Console\Command;

/**
 * Class IpAddressPingJob.
 */
class IpAddressPingJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'web-monitor:ip-address-ping-job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ping IP Address Job.';

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
        WebMonitorIpAddressPingJob::dispatch();

        return 0;
    }
}
