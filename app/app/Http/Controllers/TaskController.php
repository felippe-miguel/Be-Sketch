<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\IndexTaskRequest;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index(IndexTaskRequest $request): JsonResponse
    {
        if (empty($request->validated())) {
            return response()->json([
                'tasks' => Auth::user()->tasks->toArray()
            ]);
        }

        $tasks = Task::where('calendar_id', $request->calendar_id)->get();

        return response()->json([
            'tasks' => $tasks->values()->toArray()
        ]);
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        $data            = $request->validated();
        $data['user_id'] = Auth::id();

        $task = Task::create($data);

        return response()->json([
            'message' => 'Task successfully created',
            'id'      => $task->id
        ], 201);
    }

    public function show(Task $task): JsonResponse
    {
        if (!Gate::allows('task-show', $task)) {
            abort(403);
        }

        return response()->json($task->toArray());
    }

    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        if (!Gate::allows('task-update', $task)) {
            abort(403);
        }

        if (empty($request->validated())) {
            return response()->json(['message' => 'Nothing to update.']);
        }

        $task->fill($request->validated())->save();

        return response()->json(['message' => 'Task successfully updated']);
    }

    public function destroy(Task $task): JsonResponse
    {
        if (!Gate::allows('task-destroy', $task)) {
            abort(403);
        }

        $task->delete();

        return response()->json(['message' => 'Task successfully deleted']);
    }
}
