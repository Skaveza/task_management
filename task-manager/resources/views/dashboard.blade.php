<div class="py-6 max-w-5xl mx-auto">

    <!-- Progress Bar -->
    @php
        $total = $tasks->count();
        $completed = $tasks->where('is_completed', 1)->count();
        $percent = $total ? intval(($completed / $total) * 100) : 0;
    @endphp
    <div class="mb-6">
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-green-500 h-4 rounded-full" style="width: {{ $percent }}%"></div>
        </div>
        <p class="text-sm mt-1">{{ $completed }}/{{ $total }} tasks completed ({{ $percent }}%)</p>
    </div>

    <!-- Add Task Button -->
    <div class="mb-6">
        <a href="{{ route('tasks.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded inline-block">
            + Add New Task
        </a>
    </div>

    <!-- Category Filters -->
    <div class="mb-4 flex gap-2">
        <a href="{{ route('dashboard') }}" class="px-3 py-1 rounded {{ request()->query('category') ? 'bg-gray-200' : 'bg-blue-500 text-white' }}">All</a>
        <a href="{{ route('dashboard', ['category' => 'developer']) }}" class="px-3 py-1 rounded {{ request()->query('category') == 'developer' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">Developer</a>
        <a href="{{ route('dashboard', ['category' => 'founder']) }}" class="px-3 py-1 rounded {{ request()->query('category') == 'founder' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">Founder</a>
        <a href="{{ route('dashboard', ['category' => 'graduate']) }}" class="px-3 py-1 rounded {{ request()->query('category') == 'graduate' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">Graduate</a>
    </div>

    <!-- Task List -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse($tasks as $task)
            <div class="p-4 border rounded shadow {{ $task->is_completed ? 'bg-green-100' : 'bg-white' }}">
                <h3 class="font-bold text-lg">{{ $task->title }}</h3>
                <p class="text-gray-700">{{ $task->description }}</p>
                <span class="text-sm text-gray-500 px-2 py-1 rounded {{ 
                    $task->type == 'developer' ? 'bg-blue-100 text-blue-800' : 
                    ($task->type == 'founder' ? 'bg-yellow-100 text-yellow-800' : 
                    'bg-gray-100 text-gray-800') 
                }}">
                    {{ ucfirst($task->type) }}
                </span>

                <div class="mt-2 flex flex-wrap gap-2">
                    <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600">Edit</a>

                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 ml-3">Delete</button>
                    </form>

                    @if(!$task->is_completed)
                        <form method="POST" action="{{ route('tasks.update', $task) }}" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="is_completed" value="1">
                            <button class="text-green-600 ml-3">Mark Complete</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <p>No tasks yet.</p>
        @endforelse
    </div>

</div>