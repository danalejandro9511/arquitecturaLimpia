<?php

namespace App\Repositories\Tasks;

use App\Domains\Entities\Tasks\Task;
use App\Models\Task as TaskModel;

class EloquentTaskRepository implements TaskRepositoryInterface
{
    public function save(Task $task)
    {
        $taskModel = $task->id ? TaskModel::find($task->id) : new TaskModel();
        
        if (!$taskModel) throw new \Exception("Task not found");

        $taskModel->title = $task->title;
        $taskModel->description = $task->description;
        $taskModel->completed = $task->completed;
        $taskModel->save();

        $task->id = $taskModel->id;
    }

    public function findById($id)
    {
        $taskModel = TaskModel::find($id);

        if (!$taskModel) return null;

        return new Task(
            $taskModel->id,
            $taskModel->title,
            $taskModel->description,
            $taskModel->completed,
        );
    }

    public function delete($id)
    {
        $taskModel = TaskModel::find($id);

        if ($taskModel) $taskModel->delete();
    }

    public function getAll(): array
    {
        $taskModels = TaskModel::all();
        $tasks = [];

        foreach ($taskModels as $taskModel) {
            $tasks[] = new Task(
                $taskModel->id,
                $taskModel->title,
                $taskModel->description,
                $taskModel->completed,
            );
        }

        return $tasks;
    }

    public function getCompletedTasks(): array
    {
        $taskModels = TaskModel::completed()->get();
        $tasks = [];

        foreach ($taskModels as $taskModel) {
            $tasks[] = new Task(
                $taskModel->id,
                $taskModel->title,
                $taskModel->description,
                $taskModel->completed
            );
        }

        return $tasks;
    }
    
    public function getPendingTasks(): array
    {
        $taskModels = TaskModel::pending()->get();
        $tasks = [];

        foreach ($taskModels as $taskModel) {
            $tasks[] = new Task(
                $taskModel->id,
                $taskModel->title,
                $taskModel->description,
                $taskModel->completed
            );
        }

        return $tasks;
    }
}
