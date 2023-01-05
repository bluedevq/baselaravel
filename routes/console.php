<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('zip_log {params?*}', function ($params) {
    \App\Jobs\ZipLog::dispatch($params);
    $this->info('App\Jobs\ZipLog: Successfully !');
})->purpose('Zip file logs');

Artisan::command('dump_db {params?*}', function ($params) {
    \App\Jobs\DumpDB::dispatch($params);
    $this->info('App\Jobs\DumpDB: Successfully !');
})->purpose('Dump database for backup');
