<?php

namespace App\Presenters\Companies;

use App\Domains\Entities\Companies\Company;

class CompanyPresenter
{
    public function present(Company $company)
    {
        return [
            'id' => $company->id,
            'nombre' => $company->name,
            'cif' => $company->cif,
            'color' => $company->color,
            'direccion' => $company->address,
            'poblacion' => $company->population,
            'cp' => $company->cp,
            'telefono' => $company->phone,
            'email' => $company->email,
            'logoPath' => $company->logoPath
        ];
    }
}
