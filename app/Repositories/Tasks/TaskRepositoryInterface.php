<?php

namespace App\Repositories\Tasks;

use App\Domains\Entities\Tasks\Task;

interface TaskRepositoryInterface
{
    public function save(Task $task);
    public function findById($id);
    public function delete($id);
    public function getAll(): array;
    public function getCompletedTasks(): array;
}