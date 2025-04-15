<x-app-layout>
    <div class="container py-4">
        <div class="card p-4 shadow-sm">
            <form action="{{ route('task.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Title" name="title" required>
                </div>
                <div class="mb-3">
                    <textarea class="form-control" placeholder="Description" name="description" required></textarea>
                </div>
                <button class="btn btn-primary">Agregar tarea</button>
            </form>
            
                @foreach ($tasks as $task)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <div>
                            <input type="checkbox">
                            <strong>{{ $task->id }}</strong>
                            <span class="ms-2">{{ $task->title }}</span><br>
                            <small class="text-muted">{{ Str::words($task->description, 20) }}</small>
                        </div>
                        <div>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewTaskModal{{ $task->id }}">Ver</button>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editTaskModal{{ $task->id }}">Editar</button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteTaskModal{{ $task->id }}">Eliminar</button>
                        </div>
                    </div>
                @endforeach
            
        </div>

    </div>
</x-app-layout>