<?php

namespace App\Presenters\Retentions;

use App\Domains\Entities\Retentions\Retention;

class RetentionPresenter
{
    public function present(Retention $retention)
    {
        return [
            'id' => $retention->id,
            'nombre' => $retention->name,
            'porcentaje' => $retention->percentage
        ];
    }
}
