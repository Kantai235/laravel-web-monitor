<?php

namespace App\Domains\WebMonitor\Services;

use App\Domains\WebMonitor\Models\Monitor;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class MonitorService.
 */
class MonitorService extends BaseService
{
    /**
     * MonitorService constructor.
     *
     * @param Monitor $monitor
     */
    public function __construct(Monitor $monitor)
    {
        $this->model = $monitor;
    }

    /**
     * @param $type
     * @param bool|int $perPage
     *
     * @return mixed
     */
    public function getByType($type, $perPage = false)
    {
        if (is_numeric($perPage)) {
            return $this->model::byType($type)->paginate($perPage);
        }

        return $this->model::byType($type)->get();
    }

    /**
     * @param array $data
     *
     * @return Monitor
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Monitor
    {
        DB::beginTransaction();

        try {
            $monitor = $this->createMonitor([
                'name' => $data['name'],
                'ip_address' => $data['ip_address'] ?? null,
                'domain' => $data['domain'] ?? null,
                'port' => $data['port'] ?? 80,
                'active' => $data['active'] ?? true,
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this monitor. Please try again.'));
        }

        // event(new MonitorCreated($monitor));

        DB::commit();

        return $monitor;
    }

    /**
     * @param Monitor $monitor
     * @param array $data
     *
     * @return Monitor
     * @throws \Throwable
     */
    public function update(Monitor $monitor, array $data = []): Monitor
    {
        DB::beginTransaction();

        try {
            $monitor->update([
                'name' => $data['name'] ?? $monitor->name,
                'ip_address' => $data['ip_address'] ?? $monitor->ip_address,
                'domain' => $data['domain'] ?? $monitor->domain,
                'port' => $data['port'] ?? $monitor->port,
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this user. Please try again.'));
        }

        // event(new MonitorUpdated($monitor));

        DB::commit();

        return $monitor;
    }

    /**
     * @param Monitor $monitor
     * @param array $data
     *
     * @return Monitor
     */
    public function updatePing(Monitor $monitor, array $data = []): Monitor
    {
        $monitor->ping = $data['ping'] ?? null;

        return tap($monitor)->save();
    }

    /**
     * @param Monitor $monitor
     * @param $status
     *
     * @return Monitor
     * @throws GeneralException
     */
    public function mark(Monitor $monitor, $status): Monitor
    {
        $monitor->active = $status;

        if ($monitor->save()) {
            // event(new MonitorStatusChanged($monitor, $status));

            return $monitor;
        }

        throw new GeneralException(__('There was a problem updating this monitor. Please try again.'));
    }

    /**
     * @param Monitor $monitor
     *
     * @return Monitor
     * @throws GeneralException
     */
    public function delete(Monitor $monitor): Monitor
    {
        if ($this->deleteById($monitor->id)) {
            // event(new MonitorDeleted($user));

            return $monitor;
        }

        throw new GeneralException('There was a problem deleting this monitor. Please try again.');
    }

    /**
     * @param Monitor $monitor
     *
     * @throws GeneralException
     * @return Monitor
     */
    public function restore(Monitor $monitor): Monitor
    {
        if ($monitor->restore()) {
            // event(new MonitorRestored($monitor));

            return $monitor;
        }

        throw new GeneralException(__('There was a problem restoring this monitor. Please try again.'));
    }

    /**
     * @param Monitor $monitor
     *
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Monitor $monitor): bool
    {
        if ($monitor->forceDelete()) {
            // event(new MonitorDestroyed($monitor));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this monitor. Please try again.'));
    }

    /**
     * @param array $data
     *
     * @return Monitor
     */
    protected function createMonitor(array $data = []): Monitor
    {
        return $this->model::create([
            'name' => $data['name'],
            'ip_address' => $data['ip_address'] ?? null,
            'domain' => $data['domain'] ?? null,
            'port' => $data['port'] ?? 80,
            'ping' => $data['ping'] ?? null,
            'active' => $data['active'] ?? true,
        ]);
    }
}
