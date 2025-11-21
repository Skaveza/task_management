<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        // Get all tasks (not filtering by user for demo purposes)
        $tasks = Task::orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'success' => true,
            'data' => $tasks
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date'
        ]);

        // Create task with a default user_id (1) for demo
        // In production, you'd use auth()->id()
        $task = Task::create([
            'user_id' => 1, // Default user for demo
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'type' => 'other',
            'due_date' => $validated['due_date'] ?? null,
            'is_completed' => false
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Task created successfully',
            'data' => $task
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $task
        ], 200);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'boolean',
            'due_date' => 'nullable|date'
        ]);

        $task->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully',
            'data' => $task->fresh()
        ], 200);
    }

    public function destroy(string $id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found'
            ], 404);
        }

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully'
        ], 200);
    }

    public function toggleComplete(string $id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found'
            ], 404);
        }

        $task->is_completed = !$task->is_completed;
        $task->save();

        return response()->json([
            'success' => true,
            'message' => 'Task status updated',
            'data' => $task
        ], 200);
    }

    public function statistics(): JsonResponse
    {
        $total = Task::count();
        $completed = Task::where('is_completed', true)->count();
        $pending = Task::where('is_completed', false)->count();
        $overdue = Task::where('due_date', '<', now())
                       ->where('is_completed', false)
                       ->count();

        return response()->json([
            'success' => true,
            'data' => [
                'total_tasks' => $total,
                'completed_tasks' => $completed,
                'pending_tasks' => $pending,
                'overdue_tasks' => $overdue
            ]
        ], 200);
    }
}
