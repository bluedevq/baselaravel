<div class="card">
    <div class="card-header">ユーザー{{ !empty($isEdit) ? '編集' : '登録' }}</div>
    <div class="card-body">
        <div class="row">
            <div class="col-6 offset-3">
                {!! Form::open(['route' => 'backend.users.valid', 'method' => 'post']) !!}
                {!! Form::hidden('id', data_get($record, 'id')) !!}
                <div class="form-group">
                    <label for="email">メールアドレス <span class="text-danger">※</span></label>
                    {!! Form::text('email', data_get($record, 'email', old('email')) , ['class' => 'form-control', 'id' => 'email', 'aria-describedby' => 'emailHelp']) !!}
                    @if($errors->has('email'))<p class="error">{{ $errors->first('email') }}</p>@endif
                </div>

                <div class="form-group">
                    <label for="password">パスワード <span class="text-danger">※</span></label>
                    {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
                    @if($errors->has('password'))<p class="error">{{ $errors->first('password') }}</p>@endif
                </div>

                <div class="form-group">
                    <label for="password_confirm">パスワード（確認） <span class="text-danger">※</span></label>
                    {!! Form::password('password_confirm', ['class' => 'form-control', 'id' => 'password_confirm']) !!}
                    @if($errors->has('password_confirm'))<p class="error">{{ $errors->first('password_confirm') }}</p>@endif
                </div>

                <div class="form-group">
                    <label for="avatar">写真</label>
                    @php $avatar = !empty($record) ? data_get($record, 'avatar') : null; @endphp
                    {!! Form::upload('avatar', [
                        'class' => 'form-control input-file',
                        'ext' => getConfig('file.default.image.ext'),
                        'size' => getConfig('file.default.image.size'),
                        'accept' => getConfig('file.default.image.accept'),
                        'data-label' => '写真',
                        'show_error_input' => 1,
                        'show_remove_type' => 'button',
                        'file-uploaded' => $avatar,
                        'preview-image-class' => 'w-50',
                        'default-image' => public_url(getConfig('no_avatar')),
                        'preview-url' => $avatar ? baseStorageUrl($avatar) : public_url(getConfig('no_avatar')),
                    ]) !!}
                </div>

                <div class="form-group">
                    <a class="btn btn-default" href="{{ getBackUrl() }}">Back</a>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
