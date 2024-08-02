<?php 

namespace App\Domains\UseCases\Companies;

use App\Repositories\Companies\CompanyRepositoryInterface;

class GetAllCompanyUseCase
{
    private $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function execute(): array
    {
        return $this->companyRepository->getAll();
    }
}