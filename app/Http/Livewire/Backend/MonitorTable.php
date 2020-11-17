<?php

namespace App\Http\Livewire\Backend;

use App\Domains\WebMonitor\Models\Monitor;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class MonitorTable.
 */
class MonitorTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'name';

    /**
     * @var string
     */
    public $status;

    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table table-striped',
    ];

    /**
     * @param string $status
     */
    public function mount($status = 'active'): void
    {
        $this->status = $status;
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        if ($this->status === 'deleted') {
            return Monitor::onlyTrashed();
        }

        if ($this->status === 'deactivated') {
            return Monitor::where('active', false);
        }

        return Monitor::where('active', true);
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Name'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('IP Address'), 'ip_address')
                ->searchable()
                ->sortable(),
            Column::make(__('Domain'), 'domain')
                ->searchable()
                ->sortable(),
            Column::make(__('Port'), 'port')
                ->searchable()
                ->sortable(),
            Column::make(__('Actions'))
                ->format(function (Monitor $model) {
                    return view('backend.monitor.includes.actions', ['monitor' => $model]);
                }),
        ];
    }
}
