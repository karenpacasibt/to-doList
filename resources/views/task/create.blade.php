<x-app-layout>
    <div class="task-container single-task">
        <h1>Create new task</h1>
        <form action="{{ route('task.store') }}" method="POST" class="task">
            @csrf
            <textarea name="task" rows="10" class="task-body" placeholder="Enter your task here"></textarea>
            <div class="task-buttons">
                <a href="{{ route('task.index') }}" class="task-cancel-button">Cancel</a>
                <button class="task-submit-button">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>
