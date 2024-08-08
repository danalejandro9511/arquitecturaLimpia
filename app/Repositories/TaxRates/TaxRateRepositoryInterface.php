<?php

namespace App\Repositories\TaxRates;

use App\Domains\Entities\TaxRates\TaxRate;

interface TaxRateRepositoryInterface
{
    public function save(TaxRate $company);
    public function findById($id);
    public function delete($id);
    public function getAll(): array;
}