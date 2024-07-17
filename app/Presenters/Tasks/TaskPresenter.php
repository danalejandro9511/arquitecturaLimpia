<?php

namespace App\Presenters\Tasks;

use App\Domains\Entities\Tasks\Task;

class TaskPresenter
{
    public function present(Task $task)
    {
        return [
            'id' => $task->id,
            'titulo' => $task->title,
            'descripcion' => $task->description,
            'completada' => $task->completed,
        ];
    }
}
