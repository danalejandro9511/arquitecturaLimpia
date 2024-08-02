<?php

namespace App\Repositories\Companies;

use App\Domains\Entities\Companies\Company;
use App\Models\Company as CompanyModel;
use App\Models\Image;

class EloquentCompanyRepository implements CompanyRepositoryInterface
{
    public function save(Company $company)
    {
        $companyModel = $company->id ? CompanyModel::find($company->id) : new CompanyModel();
        
        if (!$companyModel) throw new \Exception("Company not found");

        $companyModel->name = $company->name;
        $companyModel->cif = $company->cif;
        $companyModel->color = $company->color;
        $companyModel->address = $company->address;
        $companyModel->population = $company->population;
        $companyModel->cp = $company->cp;
        $companyModel->phone = $company->phone;
        $companyModel->email = $company->email;
        $companyModel->save();

        $company->id = $companyModel->id;
    }

    public function findById($id)
    {
        $companyModel = CompanyModel::find($id);

        if (!$companyModel) return null;

        $logoPath = $companyModel->image ? $companyModel->image->path : null;

        return new Company(
            $companyModel->id,
            $companyModel->name,
            $companyModel->cif,
            $companyModel->color,
            $companyModel->address,
            $companyModel->population,
            $companyModel->cp,
            $companyModel->phone,
            $companyModel->email,
            $logoPath
        );
    }

    public function delete($id)
    {
        $companyModel = CompanyModel::find($id);

        if ($companyModel) $companyModel->delete();
    }

    public function getAll(): array
    {
        $companyModels = CompanyModel::all();
        $companies = [];

        foreach ($companyModels as $companyModel) {
            $logoPath = $companyModel->image ? $companyModel->image->path : null;
            $companies[] = new Company(
                $companyModel->id,
                $companyModel->name,
                $companyModel->cif,
                $companyModel->color,
                $companyModel->address,
                $companyModel->population,
                $companyModel->cp,
                $companyModel->phone,
                $companyModel->email,
                $logoPath
            );
        }

        return $companies;
    }

    public function attachImage(Company $company, $logoPath)
    {
        $companyModel = CompanyModel::find($company->id);

        if(!$companyModel) throw new \Exception("Company not found");

        $image = new Image();
        $image->path = $logoPath;
        $companyModel->image()->save($image);
    }
    
}
