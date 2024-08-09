<?php

namespace App\Http\Controllers;

use App\Domains\UseCases\Retentions\{CreateRetentionUseCase, UpdateRetentionUseCase, DeleteRetentionUseCase, ShowRetentionUseCase,  GetAllRetentionUseCase};
use App\Http\Requests\{CreateRetentionRequest, UpdateRetentionRequest};
use App\Models\Retention;
use App\Presenters\Retentions\RetentionPresenter;
use Illuminate\Http\Request;

class RetentionController extends Controller
{
    private $createRetentionUseCase;
    private $deleteRetentionUseCase;
    private $showRetentionUseCase;
    private $updateRetentionUseCase;
    private $getAllRetentionUseCase;
    private $retentionPresenter; 

    public function __construct(
        CreateRetentionUseCase $createRetentionUseCase, 
        ShowRetentionUseCase $showRetentionUseCase, 
        UpdateRetentionUseCase $updateRetentionUseCase, 
        DeleteRetentionUseCase $deleteRetentionUseCase,  
        GetAllRetentionUseCase $getAllRetentionUseCase,
        RetentionPresenter $retentionPresenter 
    )
    {
        $this->createRetentionUseCase = $createRetentionUseCase;
        $this->updateRetentionUseCase = $updateRetentionUseCase;
        $this->deleteRetentionUseCase = $deleteRetentionUseCase;
        $this->showRetentionUseCase = $showRetentionUseCase;
        $this->getAllRetentionUseCase = $getAllRetentionUseCase;
        $this->retentionPresenter = $retentionPresenter; 
    }

    public function index()
    {
        $retentions = $this->getAllRetentionUseCase->execute();
        $presentedRetentions = array_map([$this->retentionPresenter, 'present'], $retentions);

        return response()->json([ 'retenciones' => $presentedRetentions,]);
    }

    public function store(CreateRetentionRequest $request)
    {
        $retention = $this->createRetentionUseCase->execute($request->name, $request->percentage);
        $presentedRetention = $this->retentionPresenter->present($retention);

        return response()->json(['message' => 'Retención creada exitosamente!!', 'retencion' => $presentedRetention]);
    }

    public function show($id)
    {
        $present_retention = $this->showRetentionUseCase->execute($id);

        if (!$present_retention) return response()->json(['message' => 'Retención no encontrada'], 404);

        $presentedRetention = $this->retentionPresenter->present($present_retention);

        return response()->json(['retencion' => $presentedRetention]);
    }

    public function update(UpdateRetentionRequest $request, $id)
    {
        $retention = $this->updateRetentionUseCase->execute($id, $request->name, $request->percentage);

        if (!$retention) return response()->json(['message' => 'Retención no encontrada'], 404);

        $presentedRetention = $this->retentionPresenter->present($retention);

        return response()->json(['message' => 'Retención actualizado exitosamente!!', 'retencion' => $presentedRetention]);
    }

    public function destroy($id)
    {
        $retention = $this->deleteRetentionUseCase->execute($id);

        if (!$retention) return response()->json(['message' => 'Retención no encontrada'], 404);

        return response()->json(['message' => 'Retención eliminada exitosamente!!']);
    }
}