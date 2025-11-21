<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Create Task</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf

            <label>Title</label>
            <input type="text" name="title" class="w-full border p-2">

            <label>Description</label>
            <textarea name="description" class="w-full border p-2"></textarea>

            <label>Category</label>
            <select name="type" class="w-full border p-2">
                <option value="job_application">Job Application</option>
                <option value="skill_building">Skill Building</option>
                <option value="networking">Networking</option>
                <option value="other">Other</option>
            </select>

            <label>Due Date</label>
            <input type="date" name="due_date" class="w-full border p-2">

            <button class="mt-4 bg-green-600 text-white px-4 py-2 rounded">
                Save
            </button>
        </form>
    </div>
</x-app-layout>
