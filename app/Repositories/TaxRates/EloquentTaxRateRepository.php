<?php

namespace App\Repositories\TaxRates;

use App\Domains\Entities\TaxRates\TaxRate;
use App\Models\TaxRate as TaxRateModel;

class EloquentTaxRateRepository implements TaxRateRepositoryInterface
{
    public function save(TaxRate $taxRate)
    {
        $taxRateModel = $taxRate->id ? TaxRateModel::find($taxRate->id) : new TaxRateModel();
        
        if (!$taxRateModel) throw new \Exception("Tax rate not found");

        $taxRateModel->name = $taxRate->name;
        $taxRateModel->percentage = $taxRate->percentage;
        $taxRateModel->save();

        $taxRate->id = $taxRateModel->id;
    }
    
    public function findById($id)
    {
        $taxRateModel = TaxRateModel::find($id);

        if (!$taxRateModel) return null;

        return new TaxRate(
            $taxRateModel->id,
            $taxRateModel->name,
            $taxRateModel->percentage
        );
    }

    public function delete($id)
    {
        $taxRateModel = TaxRateModel::find($id);

        if ($taxRateModel) $taxRateModel->delete();
    }

    public function getAll(): array
    {
        $taxRates = TaxRateModel::all();

        return $taxRates->map(function($taxRate) {
            return new TaxRate(
                $taxRate->id,
                $taxRate->name,
                $taxRate->percentage
            );
        })->toArray();
    }
    
}
