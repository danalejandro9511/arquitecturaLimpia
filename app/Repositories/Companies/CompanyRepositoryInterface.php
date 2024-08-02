<?php

namespace App\Repositories\Companies;

use App\Domains\Entities\Companies\Company;
use App\Models\Company as CompanyModel;

interface CompanyRepositoryInterface
{
    public function save(Company $company);
    public function findById($id);
    public function delete($id);
    public function getAll(): array;
    public function attachImage(Company $company, $logoPath);
}