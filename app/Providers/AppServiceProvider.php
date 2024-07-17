<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Tasks\TaskRepositoryInterface;
use App\Repositories\Tasks\EloquentTaskRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TaskRepositoryInterface::class, EloquentTaskRepository::class);
    }

    public function boot()
    {
        //
    }
}
