@extends('backend.layouts.main')
@section('content')
    <div class="card">
        <div class="card-header">ユーザー確認</div>
        <div class="card-body">
            <div class="row">
                <div class="col-6 offset-3">
                    @php
                        $form = [
                            'url' => !empty($record['id']) ? route('backend.users.update', ['user' => $record['id']]) : route('backend.users.store'),
                            'method' => !empty($record['id']) ? 'put' : 'post',
                        ];
                    @endphp
                    {!! Form::open($form) !!}
                        <div>
                            メールアドレス: {{ data_get($record, 'email') }}
                        </div>
                        <div class="mt-4">
                            パスワード: ********
                        </div>
                        <div class="mt-4">
                            パスワード（確認）: ********
                        </div>
                        <div class="mt-4">
                            <div>写真:</div>
                            <div>
                                @php
                                    $avatar = !empty($record) ? data_get($record, 'avatar') : null;
                                    $avatar = !empty($avatar) ? baseStorageUrl($avatar) : public_url('assets/css/backend/img/image_default.png');
                                @endphp
                                {!! Html::image($avatar, '', ['width' => 200]) !!}
                            </div>
                        </div>
                        <div class="mt-4">
                            <a class="btn btn-default" href="{{ getBackUrl() }}">Back</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
