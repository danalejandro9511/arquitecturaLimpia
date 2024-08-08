<?php

namespace App\Domains\UseCases\TaxRates;

use App\Domains\Entities\TaxRates\TaxRate;
use App\Repositories\TaxRates\TaxRateRepositoryInterface;

class CreateTaxRateUseCase
{
    private $taxRateRepository;

    public function __construct(TaxRateRepositoryInterface $taxRateRepository)
    {
        $this->taxRateRepository = $taxRateRepository;
    }

    public function execute($name, $percentage)
    {
        $taxRate = new TaxRate(null, $name, $percentage);
        $this->taxRateRepository->save($taxRate);

        return $taxRate;
    }
}
