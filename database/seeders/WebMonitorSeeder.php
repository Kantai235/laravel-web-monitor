<?php

namespace Database\Seeders;

use App\Domains\WebMonitor\Models\Monitor;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class WebMonitorSeeder.
 */
class WebMonitorSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        Monitor::create([
            'name' => 'Google HTTP',
            'domain' => 'google.com',
            'port' => 80,
            'active' => true,
        ]);

        Monitor::create([
            'name' => 'Google HTTPS',
            'domain' => 'google.com',
            'port' => 443,
            'active' => true,
        ]);

        Monitor::create([
            'name' => 'Facebook HTTP',
            'domain' => 'facebook.com',
            'port' => 80,
            'active' => true,
        ]);

        Monitor::create([
            'name' => 'Facebook HTTPS',
            'domain' => 'facebook.com',
            'port' => 443,
            'active' => true,
        ]);

        Monitor::create([
            'name' => 'Twitter HTTP',
            'domain' => 'twitter.com',
            'port' => 80,
            'active' => true,
        ]);

        Monitor::create([
            'name' => 'Twitter HTTPS',
            'domain' => 'twitter.com',
            'port' => 443,
            'active' => true,
        ]);

        Monitor::create([
            'name' => 'Plurk HTTP',
            'domain' => 'plurk.com',
            'port' => 80,
            'active' => true,
        ]);

        Monitor::create([
            'name' => 'Plurk HTTPS',
            'domain' => 'plurk.com',
            'port' => 443,
            'active' => true,
        ]);

        Monitor::create([
            'name' => '純靠北工程師 HTTP',
            'domain' => 'kaobei.engineer',
            'port' => 80,
            'active' => true,
        ]);

        Monitor::create([
            'name' => '純靠北工程師 HTTPS',
            'domain' => 'kaobei.engineer',
            'port' => 443,
            'active' => true,
        ]);

        $this->enableForeignKeys();
    }
}
