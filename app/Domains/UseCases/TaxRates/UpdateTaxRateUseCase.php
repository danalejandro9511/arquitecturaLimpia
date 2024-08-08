<?php

namespace App\Domains\UseCases\TaxRates;

use App\Domains\Entities\TaxRates\TaxRate;
use App\Repositories\TaxRates\TaxRateRepositoryInterface;

class UpdateTaxRateUseCase
{
    private $taxRateRepository;

    public function __construct(TaxRateRepositoryInterface $taxRateRepository)
    {
        $this->taxRateRepository = $taxRateRepository;
    }

    public function execute($id, $name, $percentage): ? TaxRate
    {
        $taxRate = $this->taxRateRepository->findById($id);
        
        if (!$taxRate) return null;

        $taxRate->name = $name;
        $taxRate->percentage = $percentage;

        $this->taxRateRepository->save($taxRate);

        return $taxRate;
    }
}