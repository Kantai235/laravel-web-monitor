<?php

namespace App\Domains\WebMonitor\Http\Controllers\Backend;

use App\Domains\WebMonitor\Http\Requests\Backend\DeleteMonitorRequest;
use App\Domains\WebMonitor\Http\Requests\Backend\EditMonitorRequest;
use App\Domains\WebMonitor\Http\Requests\Backend\StoreMonitorRequest;
use App\Domains\WebMonitor\Http\Requests\Backend\UpdateMonitorRequest;
use App\Domains\WebMonitor\Models\Monitor;
use App\Domains\WebMonitor\Services\MonitorService;
use App\Http\Controllers\Controller;

/**
 * Class MonitorController.
 */
class MonitorController extends Controller
{
    /**
     * @var MonitorService
     */
    protected $monitorService;

    /**
     * MonitorController constructor.
     *
     * @param MonitorService $monitorService
     */
    public function __construct(MonitorService $monitorService)
    {
        $this->monitorService = $monitorService;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.monitor.index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.monitor.create');
    }

    /**
     * @param StoreMonitorRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StoreMonitorRequest $request)
    {
        $monitor = $this->monitorService->store($request->validated());

        return redirect()->route('admin.monitor.index', $monitor)->withFlashSuccess(__('The monitor was successfully created.'));
    }

    /**
     * @param EditMonitorRequest $request
     * @param Monitor $monitor
     *
     * @return mixed
     */
    public function edit(EditMonitorRequest $request, Monitor $monitor)
    {
        return view('backend.monitor.edit')
            ->withMonitor($monitor);
    }

    /**
     * @param UpdateMonitorRequest $request
     * @param Monitor $monitor
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateMonitorRequest $request, Monitor $monitor)
    {
        $this->monitorService->update($monitor, $request->validated());

        return redirect()->route('admin.monitor.index', $monitor)->withFlashSuccess(__('The monitor was successfully updated.'));
    }

    /**
     * @param DeleteMonitorRequest $request
     * @param Monitor $monitor
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy(DeleteMonitorRequest $request, Monitor $monitor)
    {
        $this->monitorService->delete($monitor);

        return redirect()->route('admin.monitor.deleted')->withFlashSuccess(__('The monitor was successfully deleted.'));
    }
}
