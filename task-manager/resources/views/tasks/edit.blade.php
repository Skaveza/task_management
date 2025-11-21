<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Task</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <form method="POST" action="{{ route('tasks.update', $task) }}">
            @csrf
            @method('PUT')

            <label>Title</label>
            <input type="text" name="title" value="{{ $task->title }}" class="w-full border p-2">

            <label>Description</label>
            <textarea name="description" class="w-full border p-2">{{ $task->description }}</textarea>

            <label>Category</label>
            <select name="type" class="w-full border p-2">
                <option value="job_application" {{ $task->type=='job_application' ? 'selected' : '' }}>Job Application</option>
                <option value="skill_building" {{ $task->type=='skill_building' ? 'selected' : '' }}>Skill Building</option>
                <option value="networking" {{ $task->type=='networking' ? 'selected' : '' }}>Networking</option>
                <option value="other" {{ $task->type=='other' ? 'selected' : '' }}>Other</option>
            </select>

            <label>Due Date</label>
            <input type="date" name="due_date" value="{{ $task->due_date }}" class="w-full border p-2">

            <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>
