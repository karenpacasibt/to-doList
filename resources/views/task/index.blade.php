<x-app-layout>
    <div class="container py-4">
        <div class="card p-4 shadow-sm">
            {{-- COMMENT ON THE REGISTRATION AND EDITING FORMS --}}
            {{-- <form action="{{ route('task.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Title" name="title">
                </div>
                <div class="mb-3">
                    <textarea class="form-control" placeholder="Description" name="description" ></textarea>
                </div>
                <div class="mb-3">
                    <select name="id_category" class="form-control">
                        <option value="">Selecciona una categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <select id="tags-select" name="tags[]" multiple class="form-control">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}"
                            {{ (isset($task) && $task->tags->contains($tag->id)) ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
                <button class="btn btn-primary">Agregar tarea</button>
            </form>  --}}
            <a href="{{ route('task.create') }}" class="btn btn-secondary btn-lg active" role="button"
                aria-pressed="true">New Task</a>

            @foreach ($tasks as $task)
                <div class="d-flex justify-content-between align-items-center border-bottom py-2"
                    id="task-{{ $task->id }}">
                    <div id="content-{{ $task->id }}">
                        <input class="form-check-input" type="checkbox" name="status" id="status-{{ $task->id }}"
                            onchange="markTask(this, {{ $task->id }})"
                            {{ isset($task) && $task->status ? 'checked' : '' }}>
                        <strong>{{ $task->id }}</strong>
                        <span class="ms-2">TAREA: {{ $task->title }}</span><br>
                        <small class="text-muted">{{ Str::words($task->description, 20) }}</small>
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
                    <div>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#viewTaskModal{{ $task->id }}"><i class="fas fa-eye"></i></button>
                        <a href="{{ route('task.edit', $task->id) }}" class="btn btn-warning btn-sm"><i
                                class="fas fa-pen"></i></a>
                        {{-- <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteTaskModal{{ $task->id }}"><i
                                class="fas fa-trash-alt"></i></button> --}}
                        <button class="btn btn-danger btn-sm" onclick="deleteTask({{ $task->id }})"><i
                                class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
                <!--MODAL PARA VISUALIZAR LAS TAREAS-->
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
                                    $categoryName =
                                        $categories->firstWhere('id', $task->id_category)->name ?? 'Sin categoría';
                                @endphp
                                <p>{{ $categoryName }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!--MODAL PARA EDITAR-->
                {{-- <div class="modal fade" id="editTaskModal{{ $task->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('task.update', $task) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar tarea #{{ $task->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="title" value="{{ $task->title }}">
                                        </div>
                                        <div class="mb-3">
                                            <textarea class="form-control" name="description">{{ $task->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <select name="id_category" class="form-control">
                                                <option value="">Selecciona una categoría</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"{{ $category->id == $task->id_category ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Selecciona las etiquetas correspondientes:</strong></p>
                                        <select id="tags-select" name="tags[]" multiple class="form-control">
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}"
                                                    {{ (isset($task) && $task->tags->contains($tag->id)) ? 'selected' : '' }}>
                                                    {{ $tag->name }}
                                                </option>
                                            @endforeach
                                        </select>                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning">Actualizar</button>
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div> --}}

                <!-- MODAL PARA ELIMINAR UNA TAREA -->
                {{-- <div class="modal fade" id="deleteTaskModal{{ $task->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('task.destroy', $task) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h5 class="modal-title">Eliminar tarea #{{ $task->id }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Seguro que deseas eliminar la tarea: <strong>{{ $task->title }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}
            @endforeach
            @section('scripts')
                <script>
                    function deleteTask(id) {
                        if (!confirm('¿Esta seguro de eliminar esta tarea?'))
                            return;
                        fetch(`/task/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            },
                        }).then(res => {
                            if (!res.ok) {
                                alert("Something went wrong");
                            }
                            document.getElementById(`task-${id}`).remove();
                        });
                    }

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
                            body: JSON.stringify({
                                status: checkbox.checked ? 1 : 0
                            })
                        })
                    }
                </script>
            @endsection

        </div>

    </div>
</x-app-layout>
