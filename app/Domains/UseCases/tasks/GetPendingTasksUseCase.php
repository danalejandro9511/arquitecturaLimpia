<?php

namespace App\Domains\UseCases\Tasks;

use App\Repositories\Tasks\TaskRepositoryInterface;

class GetPendingTasksUseCase
{
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(): array
    {
        return $this->taskRepository->getPendingTasks();
    }
}