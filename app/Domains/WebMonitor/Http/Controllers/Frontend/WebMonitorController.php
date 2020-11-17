<?php

namespace App\Domains\WebMonitor\Http\Controllers\Frontend;

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
        return view('frontend.monitor.index');
    }
}
