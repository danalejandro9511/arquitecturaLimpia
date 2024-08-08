<?php

namespace App\Domains\UseCases\TaxRates;

use App\Repositories\TaxRates\TaxRateRepositoryInterface;

class DeleteTaxRateUseCase
{
    private $taxRateRepository;

    public function __construct(TaxRateRepositoryInterface $taxRateRepository)
    {
        $this->taxRateRepository = $taxRateRepository;
    }

    public function execute($id): bool
    {
        $taxRate = $this->taxRateRepository->findById($id);
        if (!$taxRate) {
            return false;
        }

        //TODO: ADD BUSINESS RULES HERE

        $this->taxRateRepository->delete($id);
        return true;
    }
}