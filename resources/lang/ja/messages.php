<?php

return [
    // add
    'create_success' => '登録しました。',
    'create_failed' => '登録に失敗しました。',

    // update
    'update_success' => '編集しました。',
    'update_failed' => '更新に失敗しました。',

    // delete
    'delete_success' => '削除しました。',
    'delete_failed' => '削除に失敗しました。',

    'change_success' => '変更しました。',
    'change_failed' => '変更に失敗しました。',

    // search
    'no_result_found' => '検索条件で指定したデータは存在しません。',
    'db_not_connect' => 'DBへの接続に失敗しました。予期せぬエラーが発生していますのでシステム管理者に連絡してください。',
    'url_not_found' => '指定されたページ(URL)は見つかりません',
    'not_permission' => 'アクセス権限はありません。',
    'no_data' => 'データがありません。',

    // download
    'download_failed' => 'ダウンロードに失敗しました。',
    'no_file_download' => ':typeのファイルがありません。',

    // mail subject
    'mail_reset_password_title' => 'パスワード再発行',
    'mail_register_complete_title' => 'パートナードライブの会員登録完了',

    // send mail
    'send_success' => '送信しました。',
    'send_failed' => '送信に失敗しました。',
    'reset_password_success' => 'パスワードの再設定が完了しました。',
    'reset_password_fail' => 'パスワード再発行に失敗しました。',
    'send_reset_link_success' => '再発行パスワードのメールを送信しました。:emailをご確認ください。',

    // upload file fails
    'file_upload_failed' => 'ファイルのアップロードに失敗しました',

    // errors
    'system_error' =>'予期せぬエラーが発生しました。システム管理者に連絡してください。',

    // action
    'page_action' => [
        'index' => '一覧',
        'edit' => '編集',
        'show' => '詳細',
        'confirm' => '確認',
        'create' => '登録',
        'store' => '操作',
        'update' => '操作',
        'destroy' => '削除',
    ],

    // page title
    'page_title' => [
        'backend' => [
            'login' => 'ログイン',
            'home' => 'ホーム',
            'users' => 'ユーザー',
        ],
    ],

    // http message code
    'http_code' => [
        200 => '',
        401 => "セッションがタイムアウトしました。\n再度ログインをお願いします。",
        403 => "セッションがタイムアウトしました。\n再度ログインをお願いします。",
        404 => "お探しのページが見つかりませんでした。",
        405 => "メソッドは許可されていません。",
        500 => "システムエラーが発生しました。",
    ],
];
