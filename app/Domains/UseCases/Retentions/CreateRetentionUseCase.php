<?php

namespace App\Domains\UseCases\Retentions;

use App\Domains\Entities\Retentions\Retention;
use App\Repositories\Retentions\RetentionRepositoryInterface;

class CreateRetentionUseCase
{
    private $retentionRepository;

    public function __construct(RetentionRepositoryInterface $retentionRepository)
    {
        $this->retentionRepository = $retentionRepository;
    }

    public function execute($name, $percentage)
    {
        $retention = new Retention(null, $name, $percentage);
        $this->retentionRepository->save($retention);

        return $retention;
    }
}
