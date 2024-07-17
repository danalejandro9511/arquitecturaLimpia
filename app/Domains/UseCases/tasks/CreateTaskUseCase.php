<?php

namespace App\Domains\UseCases\Tasks;

use App\Domains\Entities\Tasks\Task;
use App\Repositories\Tasks\TaskRepositoryInterface;

class CreateTaskUseCase
{
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute($title, $description)
    {
        $task = new Task(null, $title, $description, false);
        $this->taskRepository->save($task);
        return $task;
    }
}
