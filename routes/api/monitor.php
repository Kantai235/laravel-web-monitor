<?php

use App\Domains\WebMonitor\Http\Controllers\Api\WebMonitorController;
use Illuminate\Support\Facades\Route;

/*
 * Api Access Controllers
 * All route names are prefixed with 'api.monitor'.
 */
Route::group(['prefix' => 'monitor', 'as' => 'monitor.'], function () {
    Route::get('/', [WebMonitorController::class, 'index'])->name('index');
});
