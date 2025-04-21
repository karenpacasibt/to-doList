<x-app-layout>
    <div class="container py-4">
        <div class="card p-4 shadow-sm">

            {{-- Botón para crear nueva tarea --}}
            <a href="{{ route('task.create') }}" 
               class="btn btn-secondary btn-lg active mb-3" 
               role="button" 
               aria-pressed="true">
                New Task
            </a>

            {{-- Listado de tareas --}}
            @foreach ($tasks as $task)
                <div class="d-flex justify-content-between align-items-center border-bottom py-2" id="task-{{ $task->id }}">
                    <div id="content-{{ $task->id }}">
                        <input class="form-check-input" 
                               type="checkbox" 
                               name="status" 
                               id="status-{{ $task->id }}"
                               onchange="markTask(this, {{ $task->id }})"
                               {{ $task->status ? 'checked' : '' }}>

                        <strong>{{ $task->id }}</strong>
                        <span class="ms-2">TAREA: {{ $task->title }}</span><br>
                        <small class="text-muted">{{ Str::words($task->description, 20) }}</small>

                        {{-- Etiquetas --}}
                        <div class="d-flex flex-row bd-highlight mb-3 gap-2">
                            @foreach ($tags as $tag)
                                @if ($task->tags->contains($tag->id))
                                    <p class="mb-2 badge bg-primary text-wrap rounded-pill">
                                        {{ $tag->name }}
                                    </p>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    {{-- Acciones --}}
                    <div>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewTaskModal{{ $task->id }}">
                            <i class="fas fa-eye"></i>
                        </button>

                        <a href="{{ route('task.edit', $task->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-pen"></i>
                        </a>

                        <button class="btn btn-danger btn-sm" onclick="deleteTask({{ $task->id }})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal: Ver tarea -->
                <div class="modal fade" id="viewTaskModal{{ $task->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Ver tarea #{{ $task->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <h2>{{ $task->title }}</h2>
                                <p>{{ $task->description }}</p>
                                @php
                                    $categoryName = $categories->firstWhere('id', $task->id_category)->name ?? 'Sin categoría';
                                @endphp
                                <p>{{ $categoryName }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @section('scripts')
                <script>
                    // Eliminar tarea
                    function deleteTask(id) {
                        if (!confirm('¿Está seguro de eliminar esta tarea?')) return;

                        fetch(`/task/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            },
                        }).then(res => {
                            if (!res.ok) {
                                alert("Something went wrong");
                                return;
                            }
                            document.getElementById(`task-${id}`).remove();
                        });
                    }

                    // Marcar tarea completada
                    function markTask(checkbox, id) {
                        const content = document.getElementById(`content-${id}`);

                        if (checkbox.checked) {
                            content.children[2].style.textDecoration = 'line-through';
                            content.children[4].style.textDecoration = 'line-through';
                        } else {
                            content.children[2].style.textDecoration = 'none';
                            content.children[4].style.textDecoration = 'none';
                        }

                        fetch(`/task/${id}/status`, {
                            method: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ status: checkbox.checked ? 1 : 0 })
                        });
                    }
                </script>
            @endsection
        </div>
    </div>
</x-app-layout>
