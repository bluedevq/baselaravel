<?php

return [
    // -- base config --
    // route alias
    'route_alias' => [
        'api' => env('API_ALIAS', 'api/v1'),
        'frontend' => env('FRONTEND_ALIAS', '/'),
        'backend' => env('BACKEND_ALIAS', 'management'),
    ],

    // area
    'area' => [
        'command' => 'batch',
        'frontend' => 'frontend',
        'api' => 'api',
        'backend' => 'backend',
    ],

    // model field
    'model_field' => [
        'created' => ['at' => 'created_at', 'by' => 'created_by'],
        'updated' => ['at' => 'updated_at', 'by' => 'updated_by'],
        'deleted' => ['flag' => 'deleted_flag', 'at' => '', 'by' => ''],
    ],

    // model field name
    'model_field_name' => [
        'deleted_flag' => '削除フラグ',
        'created_at' => '登録日時',
        'created_by' => '登録者ID',
        'updated_at' => '更新日時',
        'updated_by' => '更新者ID',
        'deleted_at' => '削除日時',
        'deleted_by' => '削除者ID',
    ],

    // deleted flag
    'deleted_flag' => [
        'off' => 0,
        'on' => 1,
    ],

    // static version for js, css...
    'static_version' => env('STATIC_VERSION', date('YmdHis')),

    // upload
    'media_dir' => 'uploaded/media',
    'ext_blacklist' => ['php', 'phtml', 'html'],
    'tmp_upload_dir' => 'tmp_uploads',
    'no_avatar' => 'assets/css/backend/img/image_default.png',

    // file info
    'file' => [
        'default' => [
            'image' => [
                'ext' => ['jpeg', 'jpg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF'], // extension
                'size' => ['min' => 0.001, 'max' => 2], // MB
                'accept' => '.jpeg, .jpg, .png, .gif, .JPG, .JPEG, .PNG, .GIF'
            ]
        ],
    ],

    // export csv
    'csv' => [
        'users' => [
            'filename' => 'users_' . date('YmdHis'),
            'header' => ['ID', 'メールアドレス', '登録日時', '更新日時'],
        ],
    ],

    // paginate number
    'page_number' => 10,

    // gmo
    'gmo' => [
        'url' => env('GMO_URL', ''),
        'url_link_type' => env('GMO_URL_LINK_TYPE', ''),
        'public_key' => env('GMO_PUBLIC_KEY', ''),
        'hash_key' => env('GMO_HASH_KEY', ''),
        'site_id' => env('GMO_SITE_ID', ''),
        'site_pass' => env('GMO_SITE_PASS', ''),
        'shop_id' => env('GMO_SHOP_ID', ''),
        'shop_pass' => env('GMO_SHOP_PASS', ''),
    ],

    // logs
    'logs' => [
        'zip_log' => [
            'keep_day' => env('ZIP_LOG_KEEP_DAY', 5),
        ],
        'dump_db' => [
            'file_name' => 'database_backup_' . date('YmdHis') . '.sql.gz',
            'path' => database_path('/backup'),
            'max_file' => env('DUMP_DB_MAX_FILE', 7),
        ],
    ],
];
