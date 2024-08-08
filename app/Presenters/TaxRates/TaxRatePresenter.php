<?php

namespace App\Presenters\TaxtRates;

use App\Domains\Entities\TaxRates\TaxRate;

class TaxRatePresenter
{
    public function present(TaxRate $taxRate)
    {
        return [
            'id' => $taxRate->id,
            'nombre' => $taxRate->name,
            'porcentaje' => $taxRate->percentage
        ];
    }
}
