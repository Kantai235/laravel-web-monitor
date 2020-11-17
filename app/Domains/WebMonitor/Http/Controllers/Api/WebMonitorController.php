<?php

namespace App\Domains\WebMonitor\Http\Controllers\Api;

use App\Domains\WebMonitor\Models\Monitor;
use App\Http\Controllers\Controller;

/**
 * Class WebMonitorController.
 */
class WebMonitorController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return response()->json(Monitor::where('active', true)->get());
    }
}
