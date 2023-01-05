@extends('backend.layouts.auth')
@section('content')
    <div class="container">
        <div class="wrapper">
            <div class="row">
                <div class="col-md-6 offset-md-3 mt-5">
                    {{ Form::open(['route' => 'backend.post_login', 'class' => 'form-signin formsss', 'method' => 'post']) }}

                    <div class="mt-40-xs">
                        <div class="text-center"><b>{{ __('messages.page_title.backend.login') }}</b></div>
                    </div>

                    <div class="mt-40-xs form-group error">
                        <label>{{ __('models.users.attributes.email') }}</label>
                        {!! Form::text('email', '', ['class' => 'form-control ' .  ($errors->has('email') ? 'border-error' : '')]) !!}
                        @if($errors->has('email'))<p class="error">{{ $errors->first('email') }}</p>@endif
                    </div>

                    <div class="mt-30-xs form-group">
                        <label>{{ __('models.users.attributes.password') }}</label>
                        {!! Form::password('password', ['class' => 'form-control ' .  ($errors->has('password') ? 'border-error' : '')]) !!}
                        @if($errors->has('password'))<p class="error">{{ $errors->first('password') }}</p>@endif
                    </div>

                    <button class="btn btn-success" value="Login" type="submit">ログイン</button>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
