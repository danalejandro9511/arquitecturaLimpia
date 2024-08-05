<?php

namespace App\Domains\UseCases\Companies;

use App\Repositories\Companies\CompanyRepositoryInterface;

class DeleteCompanyUseCase
{
    private $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function execute($id): bool
    {
        $company = $this->companyRepository->findById($id);
        if (!$company) {
            return false;
        }

        //TODO: ADD BUSINESS RULES HERE

        $this->companyRepository->delete($id);
        return true;
    }
}