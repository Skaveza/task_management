<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Show all tasks for logged in user
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    // Show create form
    public function create()
    {
        return view('tasks.create');
    }

    // Store new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'type' => 'required',
            'due_date' => 'nullable|date'
        ]);

        Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'due_date' => $request->due_date
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created!');
    }

    // Show edit form
    public function edit(Task $task)
    {
        $this->authorizeTask($task);

        return view('tasks.edit', compact('task'));
    }

    // Update task
    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);

        $task->update($request->only('title', 'description', 'type', 'due_date'));

        return redirect()->route('tasks.index')->with('success', 'Task updated!');
    }

    // Delete task
    public function destroy(Task $task)
    {
        $this->authorizeTask($task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted!');
    }

    // Ensure user owns the task
    private function authorizeTask(Task $task)
    {
        abort_if($task->user_id !== auth()->id(), 403);
    }
}
