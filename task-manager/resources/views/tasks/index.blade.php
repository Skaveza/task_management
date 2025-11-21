<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Your Tasks</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        
        <a href="{{ route('tasks.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded">
            + Add New Task
        </a>

        <div class="mt-6">
            @forelse($tasks as $task)
                <div class="p-4 border rounded mb-3">
                    <strong>{{ $task->title }}</strong>
                    <br>
                    <span>{{ $task->description }}</span>
                    <br>
                    <span class="text-sm text-gray-500">Category: {{ ucfirst($task->type) }}</span>

                    <div class="mt-2">
                        <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600">Edit</a>
                        
                        <form method="POST" action="{{ route('tasks.destroy', $task) }}" 
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 ml-3">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>No tasks yet.</p>
            @endforelse
        </div>

    </div>
</x-app-layout>
