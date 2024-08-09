<?php

namespace App\Repositories\Retentions;

use App\Domains\Entities\Retentions\Retention;
use App\Models\Retention as RetentionModel;

class EloquentRetentionRepository implements RetentionRepositoryInterface
{
    public function save(Retention $retention)
    {
        $retentionModel = $retention->id ? RetentionModel::find($retention->id) : new RetentionModel();
        
        if (!$retentionModel) throw new \Exception("Retention not found");

        $retentionModel->name = $retention->name;
        $retentionModel->percentage = $retention->percentage;
        $retentionModel->save();

        $retention->id = $retentionModel->id;
    }
    
    public function findById($id)
    {
        $retentionModel = RetentionModel::find($id);

        if (!$retentionModel) return null;

        return new Retention(
            $retentionModel->id,
            $retentionModel->name,
            $retentionModel->percentage
        );
    }

    public function delete($id)
    {
        $retentionModel = RetentionModel::find($id);

        if ($retentionModel) $retentionModel->delete();
    }

    public function getAll(): array
    {
        $retentions = RetentionModel::all();

        return $retentions->map(function($retention) {
            return new Retention(
                $retention->id,
                $retention->name,
                $retention->percentage
            );
        })->toArray();
    }
    
}
