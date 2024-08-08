<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ModelObserver
{
    public function created(Model $model)
    {
        Log::channel('database')->info('created', [
            'model' => get_class($model),
            'attributes' => $model->getAttributes()
        ]);
    }

    public function updated(Model $model)
    {
        Log::channel('database')->info('updated', [
            'model' => get_class($model),
            'attributes' => $model->getAttributes()
        ]);
    }

    public function deleted(Model $model)
    {
        Log::channel('database')->info('deleted', [
            'model' => get_class($model),
            'attributes' => $model->getAttributes()
        ]);
    }
}
