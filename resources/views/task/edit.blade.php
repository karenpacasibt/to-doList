<x-app-layout>
    <div class="task-container single-task">
        <h1 class="text-3xl py-4">Edit your task</h1>
        <form action="{{ route('task.update', $task) }}" method="POST" class="task">
            @csrf
            @method('PUT')
            <textarea name="task" rows="10" class="task-body" placeholder="Enter your task here">{{ $task->task }}</textarea>
            <div class="task-buttons">
                <a href="{{ route('task.index') }}" class="task-cancel-button">Cancel</a>
                <button class="task-submit-button">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>