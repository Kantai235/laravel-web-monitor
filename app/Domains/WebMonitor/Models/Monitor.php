<?php

namespace App\Domains\WebMonitor\Models;

use App\Domains\WebMonitor\Models\Traits\Method\MonitorMethod;
use App\Domains\WebMonitor\Models\Traits\Scope\MonitorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Monitor.
 */
class Monitor extends Model
{
    use HasFactory,
        SoftDeletes,
        MonitorMethod,
        MonitorScope;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'web_monitor';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'ip_address',
        'domain',
        'port',
        'ping',
        'active',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'port' => 'integer',
        'ping' => 'integer',
        'active' => 'boolean',
    ];
}
