<?php 

namespace App\Domains\UseCases\TaxRates;

use App\Repositories\TaxRates\TaxRateRepositoryInterface;

class GetAllTaxRateUseCase
{
    private $taxRateRepository;

    public function __construct(TaxRateRepositoryInterface $taxRateRepository)
    {
        $this->taxRateRepository = $taxRateRepository;
    }

    public function execute(): array
    {
        return $this->taxRateRepository->getAll();
    }
}