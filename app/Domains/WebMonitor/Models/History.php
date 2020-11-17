<?php

namespace App\Domains\WebMonitor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class History.
 */
class History extends Model
{
    use HasFactory,
        SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'web_monitor_history';

    /**
     * @var string[]
     */
    protected $fillable = [
        'monitor_id',
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
