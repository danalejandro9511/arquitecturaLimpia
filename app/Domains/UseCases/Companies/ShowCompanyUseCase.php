<?php

namespace App\Domains\UseCases\Companies;

use App\Domains\Entities\Companies\Company;
use App\Repositories\Companies\CompanyRepositoryInterface;

class ShowCompanyUseCase
{
    private $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function execute($id): ? Company
    {
        $company = $this->companyRepository->findById($id);
        
        if (!$company) return null;

        return $company;
    }
}