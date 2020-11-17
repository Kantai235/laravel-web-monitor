@extends('backend.layouts.app')

@section('title', __('User Management'))

@section('breadcrumb-links')
    @include('backend.monitor.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Monitor Management')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.monitor.create')"
                    :text="__('Create Monitor')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.monitor-table />
        </x-slot>
    </x-backend.card>
@endsection
