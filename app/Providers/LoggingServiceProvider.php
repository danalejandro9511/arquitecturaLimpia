<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Monolog\Logger;
use App\Models\Log as DatabaseLogHandler;

class LoggingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $monolog = new Logger('database');
        $monolog->pushHandler(new DatabaseLogHandler());

        $this->app['log']->extend('database', function ($app, $config) use ($monolog) {
            return $monolog;
        });
    }

    public function register()
    {
        //
    }
}
