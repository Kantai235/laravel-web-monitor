@if ($monitor->trashed())
    <x-utils.form-button
        :action="route('admin.monitor.restore', $monitor)"
        method="patch"
        button-class="btn btn-info btn-sm"
        icon="fas fa-sync-alt"
        name="confirm-item"
    >
        @lang('Restore')
    </x-utils.form-button>

    <x-utils.delete-button
        :href="route('admin.monitor.permanently-delete', $monitor)"
        :text="__('Permanently Delete')" />
@else
    <x-utils.edit-button :href="route('admin.monitor.edit', $monitor)" />

    @if (! $monitor->isActive())
        <x-utils.form-button
            :action="route('admin.monitor.mark', [$monitor, 1])"
            method="patch"
            button-class="btn btn-primary btn-sm"
            icon="fas fa-sync-alt"
            name="confirm-item"
            permission="admin.monitor.reactivate"
        >
            @lang('Reactivate')
        </x-utils.form-button>
    @endif

    <x-utils.delete-button :href="route('admin.monitor.destroy', $monitor)" />

    <div class="dropdown d-inline-block">
        <a class="btn btn-sm btn-secondary dropdown-toggle" id="moreMenuLink" href="#" role="button" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
            @lang('More')
        </a>

        <div class="dropdown-menu" aria-labelledby="moreMenuLink">
            <x-utils.form-button
                :action="route('admin.monitor.mark', [$monitor, 0])"
                method="patch"
                name="confirm-item"
                button-class="dropdown-item"
                permission="admin.monitor.deactivate"
            >
                @lang('Deactivate')
            </x-utils.form-button>
        </div>
    </div>
@endif
