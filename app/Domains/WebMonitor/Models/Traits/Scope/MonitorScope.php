<?php

namespace App\Domains\WebMonitor\Models\Traits\Scope;

/**
 * Class MonitorScope.
 */
trait MonitorScope
{
    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeOnlyDeactivated($query)
    {
        return $query->whereActive(false);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeOnlyActive($query)
    {
        return $query->whereActive(true);
    }
}
