<?php

namespace App\Providers;

use App\Models\{Company, Image, Task, User, TaxRate, Retention};
use App\Observers\ModelObserver;
use App\Repositories\Companies\CompanyRepositoryInterface;
use App\Repositories\Retentions\RetentionRepositoryInterface;
use App\Repositories\Companies\EloquentCompanyRepository;
use App\Repositories\Retentions\EloquentRetentionRepository;
use App\Repositories\Companies\EloquentImageRepository;
use App\Repositories\Companies\ImageRepositoryInterface;
use App\Repositories\Tasks\EloquentTaskRepository;
use App\Repositories\Tasks\TaskRepositoryInterface;
use App\Repositories\TaxRates\EloquentTaxRateRepository;
use App\Repositories\TaxRates\TaxRateRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TaskRepositoryInterface::class, EloquentTaskRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class, EloquentCompanyRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, EloquentImageRepository::class);
        $this->app->bind(TaxRateRepositoryInterface::class, EloquentTaxRateRepository::class);
        $this->app->bind(RetentionRepositoryInterface::class, EloquentRetentionRepository::class);
    }

    public function boot()
    {
        Company::observe(ModelObserver::class);
        Image::observe(ModelObserver::class);
        Task::observe(ModelObserver::class);
        TaxRate::observe(ModelObserver::class);
        Retention::observe(ModelObserver::class);
        User::observe(ModelObserver::class);
    }
}
