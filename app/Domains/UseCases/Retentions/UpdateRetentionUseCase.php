<?php

namespace App\Domains\UseCases\Retentions;

use App\Domains\Entities\Retentions\Retention;
use App\Repositories\Retentions\RetentionRepositoryInterface;

class UpdateRetentionUseCase
{
    private $retentionRepository;

    public function __construct(RetentionRepositoryInterface $retentionRepository)
    {
        $this->retentionRepository = $retentionRepository;
    }

    public function execute($id, $name, $percentage): ? Retention
    {
        $retention = $this->retentionRepository->findById($id);
        
        if (!$retention) return null;

        $retention->name = $name;
        $retention->percentage = $percentage;

        $this->retentionRepository->save($retention);

        return $retention;
    }
}