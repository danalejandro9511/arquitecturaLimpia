<?php

namespace App\Http\Controllers;

use App\Domains\UseCases\Companies\{CreateCompanyUseCase, UpdateCompanyUseCase, /*DeleteCompanyUseCase,*/ ShowCompanyUseCase,  GetAllCompanyUseCase};
use App\Http\Requests\{CreateCompanyRequest, UpdateCompanyRequest};
use App\Presenters\Companies\CompanyPresenter;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private $createCompanyUseCase;
    //private $deleteCompanyUseCase;
    private $showCompanyUseCase;
    private $updateCompanyUseCase;
    private $getAllCompanyUseCase;
    private $companyPresenter; 

    public function __construct(
        CreateCompanyUseCase $createCompanyUseCase, 
        ShowCompanyUseCase $showCompanyUseCase, 
        UpdateCompanyUseCase $updateCompanyUseCase, 
        //DeleteCompanyUseCase $deleteCompanyUseCase,  */
        GetAllCompanyUseCase $getAllCompanyUseCase,
        CompanyPresenter $companyPresenter 
    )
    {
        $this->createCompanyUseCase = $createCompanyUseCase;
        $this->updateCompanyUseCase = $updateCompanyUseCase;
        //$this->deleteCompanyUseCase = $deleteCompanyUseCase;
        $this->showCompanyUseCase = $showCompanyUseCase;
        $this->getAllCompanyUseCase = $getAllCompanyUseCase;
        $this->companyPresenter = $companyPresenter; 
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = $this->getAllCompanyUseCase->execute();
        $presentedCompanies = array_map([$this->companyPresenter, 'present'], $companies);

        return response()->json([
            'companies' => $presentedCompanies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCompanyRequest $request)
    {
        $logo = $request->file('logo');
        $company = $this->createCompanyUseCase->execute($request->name, $request->cif, $request->color, $request->address, $request->population, $request->cp, $request->phone, $request->email, $logo);
        $presentedCompany = $this->companyPresenter->present($company);

        return response()->json(['message' => 'Empresa creada exitosamente!!', 'company' => $presentedCompany]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $present_company = $this->showCompanyUseCase->execute($id);

        if (!$present_company) return response()->json(['message' => 'Empresa no encontrada'], 404);

        $presentedCompany = $this->companyPresenter->present($present_company);

        return response()->json(['empresa' => $presentedCompany]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, $id)
    {
        $logo = $request->file('logo');
        $company = $this->updateCompanyUseCase->execute($request->id, $request->name, $request->cif, $request->color, $request->address, $request->population, $request->cp, $request->phone, $request->email, $logo);

        if (!$company) return response()->json(['message' => 'Empresa no encontrada'], 404);

        $presentedCompany = $this->companyPresenter->present($company);

        return response()->json([
            'message' => 'Empresa actualizada exitosamente!!',
            'empresa' => $presentedCompany,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
