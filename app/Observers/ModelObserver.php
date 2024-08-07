<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ModelObserver
{
    protected $logChannel = 'database';

    public function created(Model $model)
    {
        $attributes = $model->getAttributes();
        Log::channel($this->logChannel)->info('created', ['model' => get_class($model), 'attributes' => $attributes]);
    }

    public function updated(Model $model)
    {
        Log::channel($this->logChannel)->info('updated', ['model' => get_class($model), 'attributes' => $model->getAttributes()]);
    }

    public function deleted(Model $model)
    {
        Log::channel($this->logChannel)->info('deleted', ['model' => get_class($model), 'attributes' => $model->getAttributes()]);
    }
}
