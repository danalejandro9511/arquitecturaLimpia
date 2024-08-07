<?php

namespace App\Observers;

use App\Models\Company;
use Illuminate\Support\Facades\Log;

class CompanyObserver
{
    public function created(Company $company)
    {
        Log::channel('database')->info('Empresa creada', [
            'model' => 'Company',
            'attributes' => $company->getAttributes(),
        ]);
    }

    public function updated(Company $company)
    {
        Log::channel('database')->info('Empresa actualizada', [
            'model' => 'Company',
            'attributes' => $company->getChanges(),
        ]);
    }

    public function deleted(Company $company)
    {
        Log::channel('database')->info('Empresa eliminada', [
            'model' => 'Company',
            'attributes' => $company->getAttributes(),
        ]);
    }
}
