<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .task-item {
            animation: slideIn 0.3s ease-out;
        }
        .completed {
            text-decoration: line-through;
            opacity: 0.6;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800">Task Manager Pro</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Total Tasks</p>
                        <p class="text-2xl font-bold text-indigo-600" id="totalCount">0</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-indigo-600">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Tasks</p>
                        <p class="text-3xl font-bold text-gray-800" id="statsTotal">0</p>
                    </div>
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-600">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Completed</p>
                        <p class="text-3xl font-bold text-gray-800" id="statsCompleted">0</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-600">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Pending</p>
                        <p class="text-3xl font-bold text-gray-800" id="statsPending">0</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-red-600">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Overdue</p>
                        <p class="text-3xl font-bold text-gray-800" id="statsOverdue">0</p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Task Form and List Container -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Add Task Form -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Add New Task</h2>
                    <form id="taskForm" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Task Title *</label>
                            <input type="text" id="taskTitle" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="Enter task title">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea id="taskDescription" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="Enter task description"></textarea>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Due Date</label>
                            <input type="date" id="taskDueDate"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-200 flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <span>Add Task</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Tasks List -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-800">My Tasks</h2>
                        <div class="flex space-x-2">
                            <button onclick="filterTasks('all')" id="filterAll"
                                class="px-4 py-2 rounded-lg text-sm font-medium bg-indigo-600 text-white">
                                All
                            </button>
                            <button onclick="filterTasks('pending')" id="filterPending"
                                class="px-4 py-2 rounded-lg text-sm font-medium bg-gray-200 text-gray-700 hover:bg-gray-300">
                                Pending
                            </button>
                            <button onclick="filterTasks('completed')" id="filterCompleted"
                                class="px-4 py-2 rounded-lg text-sm font-medium bg-gray-200 text-gray-700 hover:bg-gray-300">
                                Completed
                            </button>
                        </div>
                    </div>

                    <!-- Search Bar -->
                    <div class="mb-6">
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Search tasks..."
                                class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Tasks Container -->
                    <div id="tasksList" class="space-y-4 max-h-96 overflow-y-auto">
                        <!-- Tasks will be inserted here -->
                    </div>

                    <!-- Empty State -->
                    <div id="emptyState" class="text-center py-12 hidden">
                        <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p class="text-gray-500 text-lg">No tasks found</p>
                        <p class="text-gray-400 text-sm mt-2">Add your first task to get started!</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const API_URL = 'http://127.0.0.1:8000/api';
        let currentFilter = 'all';
        let allTasks = [];

        // Load tasks on page load
        document.addEventListener('DOMContentLoaded', () => {
            loadTasks();
            loadStatistics();
            
            // Setup search
            document.getElementById('searchInput').addEventListener('input', (e) => {
                searchTasks(e.target.value);
            });
        });

        // Handle form submission
        document.getElementById('taskForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const title = document.getElementById('taskTitle').value;
            const description = document.getElementById('taskDescription').value;
            const dueDate = document.getElementById('taskDueDate').value;
            
            try {
                const response = await fetch(`${API_URL}/tasks`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        title,
                        description,
                        due_date: dueDate
                    })
                });
                
                if (response.ok) {
                    document.getElementById('taskForm').reset();
                    loadTasks();
                    loadStatistics();
                    showNotification('Task added successfully!', 'success');
                }
            } catch (error) {
                showNotification('Error adding task', 'error');
            }
        });

        // Load all tasks
        async function loadTasks() {
            try {
                const response = await fetch(`${API_URL}/tasks`);
                const data = await response.json();
                allTasks = data.data || [];
                displayTasks(allTasks);
            } catch (error) {
                console.error('Error loading tasks:', error);
            }
        }

        // Display tasks
        function displayTasks(tasks) {
            const tasksList = document.getElementById('tasksList');
            const emptyState = document.getElementById('emptyState');
            
            if (tasks.length === 0) {
                tasksList.innerHTML = '';
                emptyState.classList.remove('hidden');
                return;
            }
            
            emptyState.classList.add('hidden');
            
            tasksList.innerHTML = tasks.map(task => `
                <div class="task-item bg-gray-50 rounded-lg p-4 border border-gray-200 hover:shadow-md transition duration-200">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start space-x-3 flex-1">
                            <input type="checkbox" ${task.is_completed ? 'checked' : ''} 
                                onchange="toggleTask(${task.id})"
                                class="mt-1 w-5 h-5 text-indigo-600 rounded focus:ring-2 focus:ring-indigo-500">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold ${task.is_completed ? 'completed' : ''} text-gray-800">
                                    ${task.title}
                                </h3>
                                ${task.description ? `<p class="text-gray-600 text-sm mt-1">${task.description}</p>` : ''}
                                <div class="flex items-center space-x-4 mt-2">
                                    ${task.due_date ? `
                                        <span class="text-xs px-2 py-1 rounded-full ${isOverdue(task.due_date, task.is_completed) ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600'}">
                                            📅 ${formatDate(task.due_date)}
                                        </span>
                                    ` : ''}
                                    <span class="text-xs px-2 py-1 rounded-full ${task.is_completed ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600'}">
                                        ${task.is_completed ? '✓ Completed' : '⏳ Pending'}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <button onclick="deleteTask(${task.id})" 
                            class="text-red-500 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            `).join('');
            
            document.getElementById('totalCount').textContent = tasks.length;
        }

        // Toggle task completion
        async function toggleTask(id) {
            try {
                await fetch(`${API_URL}/tasks/${id}/toggle`, {
                    method: 'PATCH'
                });
                loadTasks();
                loadStatistics();
            } catch (error) {
                showNotification('Error updating task', 'error');
            }
        }

        // Delete task
        async function deleteTask(id) {
            if (!confirm('Are you sure you want to delete this task?')) return;
            
            try {
                await fetch(`${API_URL}/tasks/${id}`, {
                    method: 'DELETE'
                });
                loadTasks();
                loadStatistics();
                showNotification('Task deleted successfully!', 'success');
            } catch (error) {
                showNotification('Error deleting task', 'error');
            }
        }

        // Filter tasks
        function filterTasks(filter) {
            currentFilter = filter;
            
            // Update button styles
            ['filterAll', 'filterPending', 'filterCompleted'].forEach(id => {
                const btn = document.getElementById(id);
                if (id === `filter${filter.charAt(0).toUpperCase() + filter.slice(1)}` || (filter === 'all' && id === 'filterAll')) {
                    btn.className = 'px-4 py-2 rounded-lg text-sm font-medium bg-indigo-600 text-white';
                } else {
                    btn.className = 'px-4 py-2 rounded-lg text-sm font-medium bg-gray-200 text-gray-700 hover:bg-gray-300';
                }
            });
            
            let filtered = allTasks;
            if (filter === 'completed') {
                filtered = allTasks.filter(task => task.is_completed);
            } else if (filter === 'pending') {
                filtered = allTasks.filter(task => !task.is_completed);
            }
            
            displayTasks(filtered);
        }

        // Search tasks
        function searchTasks(query) {
            const filtered = allTasks.filter(task => 
                task.title.toLowerCase().includes(query.toLowerCase()) ||
                (task.description && task.description.toLowerCase().includes(query.toLowerCase()))
            );
            displayTasks(filtered);
        }

        // Load statistics
        async function loadStatistics() {
            try {
                const response = await fetch(`${API_URL}/tasks-statistics`);
                const data = await response.json();
                
                if (data.success) {
                    document.getElementById('statsTotal').textContent = data.data.total_tasks;
                    document.getElementById('statsCompleted').textContent = data.data.completed_tasks;
                    document.getElementById('statsPending').textContent = data.data.pending_tasks;
                    document.getElementById('statsOverdue').textContent = data.data.overdue_tasks;
                }
            } catch (error) {
                console.error('Error loading statistics:', error);
            }
        }

        // Utility functions
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
        }

        function isOverdue(dueDate, isCompleted) {
            if (isCompleted) return false;
            return new Date(dueDate) < new Date();
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            } text-white z-50`;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>
</body>
</html>