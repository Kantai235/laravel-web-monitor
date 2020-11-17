@extends('backend.layouts.app')

@section('title', __('Deactivated Monitor'))

@section('breadcrumb-links')
    @include('backend.monitor.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Deactivated Monitor')
        </x-slot>

        <x-slot name="body">
            <livewire:backend.monitor-table status="deactivated" />
        </x-slot>
    </x-backend.card>
@endsection
