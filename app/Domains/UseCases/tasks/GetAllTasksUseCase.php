<?php 

namespace App\Domains\UseCases\Tasks;

use App\Repositories\Tasks\TaskRepositoryInterface;

class GetAllTasksUseCase
{
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(): array
    {
        return $this->taskRepository->getAll();
    }
}