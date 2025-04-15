<x-app-layout>
    <div class="task-container py-12">
        <a href="{{route('task.create')}}" class="new-task-btn">
            New task
        </a>
        <div class="tasks">
            @foreach ($tasks as $task)
                <div class="task">
                    <div class="task-body">
                        {{Str::words($task->task,20)}}
                    </div>
                    <div class="task-buttons">
                        <a href="{{route('task.show',$task)}}" class="task-view-button">View</a>
                        <a href="{{route('task.edit',$task)}}" class="task-edit-button">Edit</a>
                        <form action="{{ route('task.destroy', $task) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="task-delete-button">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="p-6">
            {{$tasks->links}}
        </div>
    </div>
</x-app-layout>