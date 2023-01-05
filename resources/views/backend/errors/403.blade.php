@extends('backend.layouts.error')
@section('content')
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <!-- flash message -->
                        <div>{{ trans('messages.not_permission') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
