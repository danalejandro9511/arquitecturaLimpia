<?php

namespace App\Domains\UseCases\Retentions;

use App\Domains\Entities\Retentions\Retention;
use App\Repositories\Retentions\RetentionRepositoryInterface;

class ShowRetentionUseCase
{
    private $retentionRepository;

    public function __construct(RetentionRepositoryInterface $retentionRepository)
    {
        $this->retentionRepository = $retentionRepository;
    }

    public function execute($id): ? Retention
    {
        $retention = $this->retentionRepository->findById($id);
        
        if (!$retention) return null;

        return $retention;
    }
}