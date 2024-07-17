<?php

namespace App\Domains\UseCases\Tasks;

use App\Repositories\Tasks\TaskRepositoryInterface;

class GetCompletedTasksUseCase
{
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(): array
    {
        return $this->taskRepository->getCompletedTasks();
    }
}