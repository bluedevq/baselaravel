<?php

namespace App\Providers;

use Core\Database\Schema\CustomBlueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // custom schema
        $this->customSchema();

        // ignore sanctum migration
        Sanctum::ignoreMigrations();

        // only HTTPs
        $this->ensureHttps();

        // custom log
        $this->app->bind('channellog', 'Core\Providers\Facades\Log\ChannelWriter');

        // custom storage
        $this->app->bind('basestorage', 'Core\Providers\Facades\Storages\CustomStorage');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // log sql
        $this->logSql();
    }

    protected function ensureHttps()
    {
        if (config('app.https')) {
            url()->forceScheme('https');
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    protected function customSchema()
    {
        $this->app->bind('db.custom.schema', function ($app) {
            $schema = $app['db']->connection()->getSchemaBuilder();
            $schema->blueprintResolver(function ($table, $callback) {
                return new CustomBlueprint($table, $callback);
            });
            return $schema;
        });
    }

    protected function logSql()
    {
        if (!isLogSql()) {
            return;
        }

        try {
            DB::listen(function ($sql) {
                $isJobs = strpos($sql->sql, 'jobs') !== false || strpos($sql->sql, 'failed_jobs') !== false;
                if (App::runningInConsole() && $isJobs) {
                    return;
                }

                foreach ($sql->bindings as $i => $binding) {
                    if ($binding instanceof \DateTime) {
                        $sql->bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                    } else {
                        if (is_string($binding)) {
                            $sql->bindings[$i] = "'$binding'";
                        }
                    }
                }
                // Insert bindings into query
                $query = str_replace(array('%', '?'), array('%%', '%s'), $sql->sql);
                $query = vsprintf($query, $sql->bindings);
                $area = strtoupper(getArea());
                $log = "[{$area}] Time: {$sql->time} - SQL: {$query}";

                logDebug($log, [], 'NASUCTRH', 'sql_log');
            });
        } catch (\Exception $exception) {
            // write log errors
        }
    }
}
