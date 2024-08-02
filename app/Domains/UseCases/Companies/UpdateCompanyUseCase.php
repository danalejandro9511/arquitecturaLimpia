<?php

namespace App\Domains\UseCases\Companies;

use App\Domains\Entities\Companies\Company;
use App\Repositories\Companies\CompanyRepositoryInterface;
use App\Repositories\Companies\ImageRepositoryInterface;

class UpdateCompanyUseCase
{
    private $companyRepository;
    private $imageRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository, ImageRepositoryInterface $imageRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->imageRepository = $imageRepository;
    }

    public function execute($id, $name, $cif, $color, $address = null, $population = null, $cp = null, $phone, $email = null, $logo = null): ? Company
    {
        $company = $this->companyRepository->findById($id);
        
        if (!$company) return null;

        if ($name !== null) $company->name = $name;

        if ($cif !== null) $company->cif = $cif;

        if ($color !== null) $company->color = $color;

        if ($address !== null) $company->address = $address;

        if ($population !== null) $company->population = $population;
        
        if ($cp !== null) $company->cp = $cp;
        
        if ($phone !== null) $company->phone = $phone;
        
        if ($email !== null) $company->email = $email;
        
        if ($logo !== null) {
            $logoPath = $this->imageRepository->store($logo, 'logos');
            $this->companyRepository->attachImage($company, $logoPath);
            $company->logoPath = $logoPath;
        }
        
        $this->companyRepository->save($company);

        return $company;
    }
}