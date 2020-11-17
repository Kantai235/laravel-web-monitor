@inject('model', '\App\Domains\WebMonitor\Models\Monitor')

@extends('backend.layouts.app')

@section('title', __('Update Monitor'))

@section('content')
    <x-forms.patch :action="route('admin.monitor.update', $monitor)">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Monitor')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.monitor.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                    <div class="col-md-10">
                        <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $monitor->name }}" maxlength="255" required />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="ip_address" class="col-md-2 col-form-label">@lang('IP Address')</label>

                    <div class="col-md-10">
                        <input type="text" name="ip_address" class="form-control" placeholder="{{ __('IP Address') }}" value="{{ old('ip_address') ?? $monitor->ip_address }}" maxlength="255" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="domain" class="col-md-2 col-form-label">@lang('Domain')</label>

                    <div class="col-md-10">
                        <input type="text" name="domain" class="form-control" placeholder="{{ __('Domain') }}" value="{{ old('domain') ?? $monitor->domain }}" maxlength="255" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="port" class="col-md-2 col-form-label">@lang('Port')</label>

                    <div class="col-md-10">
                        <input type="number" name="port" class="form-control" placeholder="{{ __('Port') }}" value="{{ old('port') ?? $monitor->port }}" />
                    </div>
                </div><!--form-group-->
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Monitor')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
