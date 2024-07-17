<?php

namespace App\Domains\UseCases\Tasks;

use App\Domains\Entities\Tasks\Task;
use App\Repositories\Tasks\TaskRepositoryInterface;

class UpdateTaskUseCase
{
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute($id, $title = null, $description = null): ? Task
    {
        $task = $this->taskRepository->findById($id);
        
        if (!$task) return null;

        if ($title !== null) $task->title = $title;

        if ($description !== null) $task->description = $description;

        $this->taskRepository->save($task);

        return $task;
    }
}