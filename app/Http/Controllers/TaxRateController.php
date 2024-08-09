<?php

namespace App\Http\Controllers;

use App\Domains\UseCases\TaxRates\{CreateTaxRateUseCase, UpdateTaxRateUseCase, DeleteTaxRateUseCase, ShowTaxRateUseCase,  GetAllTaxRateUseCase};
use App\Http\Requests\{CreateTaxRateRequest, UpdateTaxRateRequest};
use App\Models\TaxRate;
use App\Presenters\TaxRates\TaxRatePresenter;
use Illuminate\Http\Request;

class TaxRateController extends Controller
{
    private $createTaxRateUseCase;
    private $deleteTaxRateUseCase;
    private $showTaxRateUseCase;
    private $updateTaxRateUseCase;
    private $getAllTaxRateUseCase;
    private $taxRatePresenter; 

    public function __construct(
        CreateTaxRateUseCase $createTaxRateUseCase, 
        ShowTaxRateUseCase $showTaxRateUseCase, 
        UpdateTaxRateUseCase $updateTaxRateUseCase, 
        DeleteTaxRateUseCase $deleteTaxRateUseCase,  
        GetAllTaxRateUseCase $getAllTaxRateUseCase,
        TaxRatePresenter $taxRatePresenter 
    )
    {
        $this->createTaxRateUseCase = $createTaxRateUseCase;
        $this->updateTaxRateUseCase = $updateTaxRateUseCase;
        $this->deleteTaxRateUseCase = $deleteTaxRateUseCase;
        $this->showTaxRateUseCase = $showTaxRateUseCase;
        $this->getAllTaxRateUseCase = $getAllTaxRateUseCase;
        $this->taxRatePresenter = $taxRatePresenter; 
    }

    public function index()
    {
        $taxRates = $this->getAllTaxRateUseCase->execute();
        $presentedTaxRates = array_map([$this->taxRatePresenter, 'present'], $taxRates);

        return response()->json([ 'ivas' => $presentedTaxRates,]);
    }

    public function store(CreateTaxRateRequest $request)
    {
        $taxRate = $this->createTaxRateUseCase->execute($request->name, $request->percentage);
        $presentedTaxRate = $this->taxRatePresenter->present($taxRate);

        return response()->json(['message' => 'IVA creado exitosamente!!', 'iva' => $presentedTaxRate]);
    }

    public function show($id)
    {
        $present_taxRate = $this->showTaxRateUseCase->execute($id);

        if (!$present_taxRate) return response()->json(['message' => 'IVA no encontrado'], 404);

        $presentedTaxRate = $this->taxRatePresenter->present($present_taxRate);

        return response()->json(['iva' => $presentedTaxRate]);
    }

    public function update(UpdateTaxRateRequest $request, $id)
    {
        $taxRate = $this->updateTaxRateUseCase->execute($id, $request->name, $request->percentage);

        if (!$taxRate) return response()->json(['message' => 'IVA no encontrado'], 404);

        $presentedTaxRate = $this->taxRatePresenter->present($taxRate);

        return response()->json(['message' => 'IVA actualizado exitosamente!!', 'iva' => $presentedTaxRate]);
    }

    public function destroy($id)
    {
        $taxRate = $this->deleteTaxRateUseCase->execute($id);

        if (!$taxRate) return response()->json(['message' => 'IVA no encontrado'], 404);

        return response()->json(['message' => 'IVA eliminado exitosamente!!']);
    }
}