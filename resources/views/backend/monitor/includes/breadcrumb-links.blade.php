<x-utils.link
    class="c-subheader-nav-link"
    :href="route('admin.monitor.deactivated')"
    :text="__('Deactivated Monitor')"
    permission="admin.monitor.reactivate" />

@if ($logged_in_user->hasAllAccess())
    <x-utils.link class="c-subheader-nav-link" :href="route('admin.monitor.deleted')" :text="__('Deleted Monitor')" />
@endif
