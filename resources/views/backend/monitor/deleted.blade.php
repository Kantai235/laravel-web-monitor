@extends('backend.layouts.app')

@section('title', __('Deleted Monitor'))

@section('breadcrumb-links')
    @include('backend.monitor.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Deleted Monitor')
        </x-slot>

        <x-slot name="body">
            <livewire:backend.monitor-table status="deleted" />
        </x-slot>
    </x-backend.card>
@endsection
