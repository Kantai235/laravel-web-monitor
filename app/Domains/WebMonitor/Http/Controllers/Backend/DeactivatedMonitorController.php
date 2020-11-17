<?php

namespace App\Domains\WebMonitor\Http\Controllers\Backend;

use App\Domains\WebMonitor\Models\Monitor;
use App\Domains\WebMonitor\Services\MonitorService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class DeactivatedMonitorController.
 */
class DeactivatedMonitorController extends Controller
{
    /**
     * @var MonitorService
     */
    protected $monitorService;

    /**
     * DeactivatedMonitorController constructor.
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
        return view('backend.monitor.deactivated');
    }

    /**
     * @param Request $request
     * @param Monitor $monitor
     * @param $status
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(Request $request, Monitor $monitor, $status)
    {
        $this->monitorService->mark($monitor, (int) $status);

        return redirect()->route(
            (int) $status === 1 || ! $request->user()->can('admin.monitor.reactivate') ?
                'admin.monitor.index' :
                'admin.monitor.deactivated'
        )->withFlashSuccess(__('The monitor was successfully updated.'));
    }
}
