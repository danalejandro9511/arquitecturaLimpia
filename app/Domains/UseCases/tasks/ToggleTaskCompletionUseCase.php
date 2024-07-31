<?php 

namespace App\Domains\UseCases\Tasks;

use App\Repositories\Tasks\TaskRepositoryInterface;
use App\Domains\Entities\Tasks\Task;

class ToggleTaskCompletionUseCase
{
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute($id): ?Task
    {
        $task = $this->taskRepository->findById($id);
        
        if (!$task) {
            return null;
        }

        $task->completed = !$task->completed;
        $this->taskRepository->save($task);

        return $task;
    }
}