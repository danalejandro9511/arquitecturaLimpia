<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Tasks\TaskRepositoryInterface;
use App\Repositories\Companies\CompanyRepositoryInterface;
use App\Repositories\Companies\ImageRepositoryInterface;
use App\Repositories\Tasks\EloquentTaskRepository;
use App\Repositories\Companies\EloquentCompanyRepository;
use App\Repositories\Companies\EloquentImageRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TaskRepositoryInterface::class, EloquentTaskRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class, EloquentCompanyRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, EloquentImageRepository::class);
    }

    public function boot()
    {
        //
    }
}
