@extends('backend.layouts.main')
@section('content')
    <div class="card">
        <div class="card-header">ユーザー一覧</div>
        <div class="card-body">
            <div class="row">
                <div class="col-6 offset-3">
                    {!! Form::open(['route' => 'backend.users.index', 'method' => 'get']) !!}
                    <div class="form-group row">
                        <label for="email">メールアドレス</label>
                        {!! Form::text('email', request()->get('email'), ['class' => 'form-control', 'id' => 'email']) !!}
                    </div>
                    <div class="form-group row">
                        <a href="{{ route('backend.users.index') }}" class="btn btn-default">検索条件をクリア</a>
                        <button type="submit" class="btn btn-success ml-3">検索する</button>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="row">
                <div class="col-5">
                    @include('backend.elements._paginator')
                </div>
                <div class="col-7 text-right">
                    <a class="btn btn-success" href="{{ route('backend.users.create') }}">ユーザー登録</a>
                    <a class="btn btn-info" href="{{ route('backend.users.downloadCsv', request()->all()) }}">csvをダウンロード</a>
                </div>
            </div>
            <div class="mt-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>@sortablelink('id', ' ID')</th>
                            <th>@sortablelink('email', " メールアドレス")</th>
                            <th>@sortablelink('created_at', " 登録日時")</th>
                            <th>@sortablelink('updated_at', " 更新日時")</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($records->total())
                            @foreach($records as $record)
                                <tr>
                                    <td>{{ $record->id }}</td>
                                    <td>{{ $record->email }}</td>
                                    <td>{{ $record->created_at }}</td>
                                    <td>{{ $record->updated_at }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ backUrl('backend.users.show', ['user' => $record->id]) }}">表示</a>
                                        <a class="btn btn-success" href="{{ backUrl('backend.users.edit', ['user' => $record->id]) }}">編集</a>
                                        <a class="btn btn-danger" data-action="{{ backUrl('backend.users.destroy', ['user' => $record->id]) }}" onclick="submitDestroy(this);" >削除</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">{{ __('messages.no_data') }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div>
                    @include('backend.elements._paging')
                </div>
            </div>
        </div>
    </div>
    {!! Form::open(['url' => '', 'method' => 'DELETE', 'id' => 'formDestroy']) !!}
    {!! Form::close() !!}
@endsection

@push('scripts')
    <script type="text/javascript">
        function submitDestroy(e)
        {
            var action = $(e).data('action');
            var formDestroy = $('#formDestroy');

            Swal.fire({
                title: '',
                text: "削除します。よろしいですか？",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'キャンセル',
                confirmButtonText: 'はい'
            }).then(function (success) {
                if (success.value) {
                    formDestroy.attr('action', action);
                    formDestroy.submit();
                }
            });
        }
    </script>
@endpush

