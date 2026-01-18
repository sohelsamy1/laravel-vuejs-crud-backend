<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Task\TaskResource;
use App\Http\Resources\Task\TaskCollection;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Controllers\API\Base\BaseApiController;

class TaskController extends BaseApiController
{

    public function index(): JsonResponse
    {
        try {
            $tasks = Auth::user()->tasks()->latest()->paginate(10);
            return $this->success(new TaskCollection($tasks), 'Tasks fetched successfully');
        } catch (\Throwable $e) {

            return $this->error('Failed to fetch tasks', 500, $e);
        }
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        try {
            $task = Auth::user()->tasks()->create($request->validated());
            return $this->success(new TaskResource($task), 'Task created successfully', 201);
        } catch (\Throwable $e) {
            return $this->error('Failed to create task', 500, $e);
        }
    }

     public function show(Task $task): JsonResponse
    {
        try {
            $this->authorize('view', $task);
            return $this->success(new TaskResource($task), 'Task details retrieved');
        } catch (\Throwable $e) {
            return $this->error('Unauthorized or Task not found', 403, $e);
        }
    }

     public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        try {
            $this->authorize('update', $task);
            $task->update($request->validated());
            return $this->success(new TaskResource($task), 'Task updated successfully');
        } catch (\Throwable $e) {
            return $this->error('Failed to update task', 500, $e);
        }
    }

     public function destroy(Task $task): JsonResponse
    {
        try {
            $this->authorize('delete', $task);
            $task->delete();
            return $this->success(null, 'Task soft-deleted');
        } catch (\Throwable $e) {
            return $this->error('Failed to delete task', 500, $e);
        }
    }

     public function restore($id): JsonResponse
    {
        try {
            $task = Task::withTrashed()->findOrFail($id);
            $this->authorize('restore', $task);
            $task->restore();
            return $this->success(new TaskResource($task), 'Task restored successfully');
        } catch (\Throwable $e) {
            return $this->error('Failed to restore task', 500, $e);
        }
    }
}
