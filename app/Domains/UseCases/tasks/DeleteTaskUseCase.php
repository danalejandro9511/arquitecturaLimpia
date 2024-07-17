<?php

namespace App\Domains\UseCases\Tasks;

use App\Repositories\Tasks\TaskRepositoryInterface;

class DeleteTaskUseCase
{
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute($id): bool
    {
        $task = $this->taskRepository->findById($id);
        if (!$task) {
            return false;
        }

        $this->taskRepository->delete($id);
        return true;
    }
}