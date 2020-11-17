@extends('frontend.layouts.app')

@section('title', __('Web Monitor Dashboard'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <monitor-list></monitor-list>
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
