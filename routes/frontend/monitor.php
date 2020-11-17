<?php

use App\Domains\WebMonitor\Http\Controllers\Frontend\WebMonitorController;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Access Controllers
 * All route names are prefixed with 'frontend.monitor'.
 */
Route::group(['as' => 'monitor.'], function () {
    Route::get('/monitor', [WebMonitorController::class, 'index'])
        ->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Web Monitor'), route('frontend.monitor.index'));
        });
});
