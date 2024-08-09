<?php

namespace App\Domains\UseCases\Retentions;

use App\Repositories\Retentions\RetentionRepositoryInterface;

class DeleteRetentionUseCase
{
    private $retentionRepository;

    public function __construct(RetentionRepositoryInterface $retentionRepository)
    {
        $this->retentionRepository = $retentionRepository;
    }

    public function execute($id): bool
    {
        $retention = $this->retentionRepository->findById($id);
        if (!$retention) {
            return false;
        }

        //TODO: ADD BUSINESS RULES HERE

        $this->retentionRepository->delete($id);
        return true;
    }
}