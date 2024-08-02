<?php

namespace App\Domains\UseCases\Companies;

use App\Domains\Entities\Companies\Company;
use App\Repositories\Companies\CompanyRepositoryInterface;
use App\Repositories\Companies\ImageRepositoryInterface;

class CreateCompanyUseCase
{
    private $companyRepository;
    private $imageRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository, ImageRepositoryInterface $imageRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->imageRepository = $imageRepository;
    }

    public function execute($name, $cif, $color, $address, $population, $cp, $phone, $email, $logo = null)
    {
        $company = new Company(null, $name, $cif, $color, $address, $population, $cp, $phone, $email);
        $this->companyRepository->save($company);

        // Manejo del logo si está presente
        if ($logo) {
            $logoPath = $this->imageRepository->store($logo, 'logos');
            $this->companyRepository->attachImage($company, $logoPath);
            $company->logoPath = $logoPath;
        }

        return $company;
    }
}
