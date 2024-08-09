<?php 

namespace App\Domains\UseCases\Retentions;

use App\Repositories\Retentions\RetentionRepositoryInterface;

class GetAllRetentionUseCase
{
    private $retentionRepository;

    public function __construct(RetentionRepositoryInterface $retentionRepository)
    {
        $this->retentionRepository = $retentionRepository;
    }

    public function execute(): array
    {
        return $this->retentionRepository->getAll();
    }
}