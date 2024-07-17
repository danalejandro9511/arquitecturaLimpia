<?php

namespace App\Domains\UseCases\Tasks;

use App\Domains\Entities\Tasks\Task;
use App\Repositories\Tasks\TaskRepositoryInterface;

class ShowTaskUseCase
{
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute($id): ? Task
    {
        $task = $this->taskRepository->findById($id);
        
        if (!$task) return null;

        return $task;
    }
}