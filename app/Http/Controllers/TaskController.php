<?php

namespace App\Http\Controllers;

use App\Domains\UseCases\Tasks\{CreateTaskUseCase, UpdateTaskUseCase, DeleteTaskUseCase, ShowTaskUseCase, GetAllTasksUseCase, GetCompletedTasksUseCase, GetPendingTasksUseCase, ToggleTaskCompletionUseCase};
use App\Presenters\Tasks\TaskPresenter;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $createTaskUseCase;
    private $deleteTaskUseCase;
    private $showTaskUseCase;
    private $updateTaskUseCase;
    private $getAllTasksUseCase;
    private $getCompletedTasksUseCase;
    private $getPendingTasksUseCase;
    private $toggleTaskCompletionUseCase;
    private $taskPresenter;

    public function __construct(
        CreateTaskUseCase $createTaskUseCase, 
        ShowTaskUseCase $showTaskUseCase, 
        UpdateTaskUseCase $updateTaskUseCase, 
        DeleteTaskUseCase $deleteTaskUseCase, 
        GetAllTasksUseCase $getAllTasksUseCase,
        GetCompletedTasksUseCase $getCompletedTasksUseCase,
        GetPendingTasksUseCase $getPendingTasksUseCase,
        ToggleTaskCompletionUseCase $toggleTaskCompletionUseCase,
        TaskPresenter $taskPresenter
    )
    {
        $this->createTaskUseCase = $createTaskUseCase;
        $this->updateTaskUseCase = $updateTaskUseCase;
        $this->deleteTaskUseCase = $deleteTaskUseCase;
        $this->showTaskUseCase = $showTaskUseCase;
        $this->getAllTasksUseCase = $getAllTasksUseCase;
        $this->getCompletedTasksUseCase = $getCompletedTasksUseCase;
        $this->getPendingTasksUseCase = $getPendingTasksUseCase;
        $this->toggleTaskCompletionUseCase = $toggleTaskCompletionUseCase;
        $this->taskPresenter = $taskPresenter;
    }

    public function create(Request $request)
    {
        $task = $this->createTaskUseCase->execute($request->title, $request->description);
        $presentedTask = $this->taskPresenter->present($task);

        return response()->json(['message' => 'Tarea creada exitosamente!!', 'task' => $presentedTask]);
    }

    public function show($id)
    {
        $task = $this->showTaskUseCase->execute($id);

        if (!$task) return response()->json(['message' => 'Tarea no encontrada'], 404);

        $presentedTask = $this->taskPresenter->present($task);

        return response()->json(['task' => $presentedTask]);
    }

    public function update(Request $request, $id)
    {
        $task = $this->updateTaskUseCase->execute($id, $request->title, $request->description);

        if (!$task) return response()->json(['message' => 'Tarea no encontrada'], 404);

        $presentedTask = $this->taskPresenter->present($task);

        return response()->json([
            'message' => 'Tarea actualizada exitosamente!!',
            'task' => $presentedTask,
        ]);
    }

    public function delete($id)
    {
        $result = $this->deleteTaskUseCase->execute($id);

        if (!$result) return response()->json(['message' => 'Tarea no encontrada'], 404);

        return response()->json(['message' => 'Tarea eliminada exitosamente!!']);
    }

    public function index()
    {
        $tasks = $this->getAllTasksUseCase->execute();
        $presentedTasks = array_map([$this->taskPresenter, 'present'], $tasks);

        return response()->json([
            'tasks' => $presentedTasks,
        ]);
    }

    public function completed()
    {
        $tasks = $this->getCompletedTasksUseCase->execute();
        $presentedTasks = array_map([$this->taskPresenter, 'present'], $tasks);

        return response()->json([
            'tasks' => $presentedTasks,
        ]);
    }
    
    public function pending()
    {
        $tasks = $this->getPendingTasksUseCase->execute();
        $presentedTasks = array_map([$this->taskPresenter, 'present'], $tasks);

        return response()->json([
            'tasks' => $presentedTasks,
        ]);
    }

    public function toggleCompletion($id)
    {
        $task = $this->ToggleTaskCompletionUseCase->execute($id);
        if (!$task) {
            return response()->json(['message' => 'Tarea no encontrada'], 404);
        }

        $presentedTask = $this->taskPresenter->present($task);

        return response()->json([
            'message' => 'Task completion status toggled successfully',
            'task' => $presentedTask,
        ]);
    }
}
