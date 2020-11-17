<?php

use App\Domains\WebMonitor\Http\Controllers\Backend\DeactivatedMonitorController;
use App\Domains\WebMonitor\Http\Controllers\Backend\DeletedMonitorController;
use App\Domains\WebMonitor\Http\Controllers\Backend\MonitorController;
use App\Domains\WebMonitor\Models\Monitor;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.monitor'.
Route::group([
    'prefix' => 'monitor',
    'as' => 'monitor.',
    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group([
        'middleware' => 'role:'.config('boilerplate.access.role.monitor'),
    ], function () {
        Route::get('deleted', [DeletedMonitorController::class, 'index'])
            ->name('deleted')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.monitor.index')
                    ->push(__('Deleted Monitor'), route('admin.monitor.deleted'));
            });

        Route::get('create', [MonitorController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.monitor.index')
                    ->push(__('Create Monitor'), route('admin.monitor.create'));
            });

        Route::post('/', [MonitorController::class, 'store'])->name('store');

        Route::group(['prefix' => '{monitor}'], function () {
            Route::get('edit', [MonitorController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Monitor $monitor) {
                    $trail->parent('admin.monitor.index', $monitor)
                        ->push(__('Edit'), route('admin.monitor.edit', $monitor));
                });

            Route::patch('/', [MonitorController::class, 'update'])->name('update');
            Route::delete('/', [MonitorController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => '{deletedMonitor}'], function () {
            Route::patch('restore', [DeletedMonitorController::class, 'update'])->name('restore');
            Route::delete('permanently-delete', [DeletedMonitorController::class, 'destroy'])->name('permanently-delete');
        });
    });

    Route::group([
        'middleware' => 'permission:admin.monitor.list|admin.monitor.deactivate|admin.monitor.reactivate|admin.monitor.impersonate',
    ], function () {
        Route::get('deactivated', [DeactivatedMonitorController::class, 'index'])
            ->name('deactivated')
            ->middleware('permission:admin.monitor.reactivate')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.monitor.index')
                    ->push(__('Deactivated Monitor'), route('admin.monitor.deactivated'));
            });

        Route::get('/', [MonitorController::class, 'index'])
            ->name('index')
            ->middleware('permission:admin.monitor.list|admin.monitor.deactivate|admin.monitor.impersonate')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Monitor Management'), route('admin.monitor.index'));
            });

        Route::group(['prefix' => '{monitor}'], function () {
            Route::patch('mark/{status}', [DeactivatedMonitorController::class, 'update'])
                ->name('mark')
                ->where(['status' => '[0,1]'])
                ->middleware('permission:admin.monitor.deactivate|admin.monitor.reactivate');
        });
    });
});
