<?php

namespace App\Http\Controllers;

use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        // Base query: tasks for the logged-in user
        $tasksQuery = Task::where('user_id', auth()->id());

        // Apply category filter if present in URL query
        if ($category = request()->query('category')) {
            $tasksQuery->where('type', $category);
        }

        // Get tasks ordered by latest
        $tasks = $tasksQuery->latest()->get();

        // Pass tasks to the dashboard view
        return view('dashboard', compact('tasks'));
    }
}
