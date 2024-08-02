<?php

namespace App\Http\Controllers;

use App\Domains\UseCases\Companies\{CreateCompanyUseCase, /*UpdateCompanyUseCase, DeleteCompanyUseCase, ShowCompanyUseCase,  */GetAllCompanyUseCase};
use App\Presenters\Companies\CompanyPresenter;
use App\Http\Requests\CreateCompanyRequest;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private $createCompanyUseCase;
    /*private $deleteCompanyUseCase;
    private $showCompanyUseCase;
    private $updateCompanyUseCase; */
    private $getAllCompanyUseCase;
    private $companyPresenter; 

    public function __construct(
        CreateCompanyUseCase $createCompanyUseCase, 
        /*ShowCompanyUseCase $showCompanyUseCase, 
        UpdateCompanyUseCase $updateCompanyUseCase, 
        DeleteCompanyUseCase $deleteCompanyUseCase,  */
        GetAllCompanyUseCase $getAllCompanyUseCase,
        CompanyPresenter $companyPresenter 
    )
    {
        $this->createCompanyUseCase = $createCompanyUseCase;
        /*$this->updateCompanyUseCase = $updateCompanyUseCase;
        $this->deleteCompanyUseCase = $deleteCompanyUseCase;
        $this->showCompanyUseCase = $showCompanyUseCase; */
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
