@extends('frontend.layout.error')
@section('content')
    <div class="alert alert-danger alert-dismissible" role="alert">
        <!-- flash message -->
        <div>{{ trans('messages.not_permission') }}</div>
    </div>
@endsection
