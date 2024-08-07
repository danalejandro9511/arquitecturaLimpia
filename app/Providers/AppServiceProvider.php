<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use App\Observers\ModelObserver;
use App\Repositories\Tasks\TaskRepositoryInterface;
use App\Repositories\Companies\CompanyRepositoryInterface;
use App\Repositories\Companies\ImageRepositoryInterface;
use App\Repositories\Tasks\EloquentTaskRepository;
use App\Repositories\Companies\EloquentCompanyRepository;
use App\Repositories\Companies\EloquentImageRepository;
use App\Observers\CompanyObserver;
use App\Models\Company;

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
        Company::observe(CompanyObserver::class);
    }
}
