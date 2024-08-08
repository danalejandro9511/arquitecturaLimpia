<?php

namespace App\Domains\UseCases\TaxRates;

use App\Domains\Entities\TaxRates\TaxRate;
use App\Repositories\TaxRates\TaxRateRepositoryInterface;

class ShowTaxRateUseCase
{
    private $taxRateRepository;

    public function __construct(TaxRateRepositoryInterface $taxRateRepository)
    {
        $this->taxRateRepository = $taxRateRepository;
    }

    public function execute($id): ? TaxRate
    {
        $taxRate = $this->taxRateRepository->findById($id);
        
        if (!$taxRate) return null;

        return $taxRate;
    }
}