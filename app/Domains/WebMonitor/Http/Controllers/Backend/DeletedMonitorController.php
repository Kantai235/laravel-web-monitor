<?php

namespace App\Domains\WebMonitor\Http\Controllers\Backend;

use App\Domains\WebMonitor\Models\Monitor;
use App\Domains\WebMonitor\Services\MonitorService;
use App\Http\Controllers\Controller;

/**
 * Class DeletedMonitorController.
 */
class DeletedMonitorController extends Controller
{
    /**
     * @var MonitorService
     */
    protected $monitorService;

    /**
     * DeletedMonitorController constructor.
     *
     * @param MonitorService $monitorService
     */
    public function __construct(MonitorService $monitorService)
    {
        $this->monitorService = $monitorService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.monitor.deleted');
    }

    /**
     * @param Monitor $deletedMonitor
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(Monitor $deletedMonitor)
    {
        $this->monitorService->restore($deletedMonitor);

        return redirect()->route('admin.monitor.index')->withFlashSuccess(__('The monitor was successfully restored.'));
    }

    /**
     * @param Monitor $deletedMonitor
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy($deletedMonitor)
    {
        $this->monitorService->destroy($deletedMonitor);

        return redirect()->route('admin.monitor.deleted')->withFlashSuccess(__('The monitor was permanently deleted.'));
    }
}
