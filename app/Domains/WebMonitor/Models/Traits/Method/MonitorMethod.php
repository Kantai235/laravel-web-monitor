<?php

namespace App\Domains\WebMonitor\Models\Traits\Method;

/**
 * Trait MonitorMethod.
 */
trait MonitorMethod
{
    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }
}
