<x-app-layout>
    <div class="task-container single-task">
        <div class="task-header">
            <h1 class="text-3xl py-4">Task: {{ $task->created_at }}</h1>
            <div class="task-buttons">
                <a href="{{ route('task.edit', $task) }}" class="task-edit-button">Edit</a>
                <form action="{{ route('task.destroy', $task) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="task-delete-button">Delete</button>
                </form>
            </div>
        </div>
        <div class="task">
            <div class="task-body">
                {{ $task->task }}
            </div>
        </div>
    </div>
</x-app-layout>