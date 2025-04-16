<x-app-layout>
    <div class="container py-4">
        <div class="card p-4 shadow-sm">
            <form action="{{ route('tag.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Title" name="title" required>
                </div>
                <button class="btn btn-primary">Agregar Etiqueta</button>
            </form>
            
                @foreach ($tags as $tag)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <div>
                            <strong>{{ $tag->id }}</strong>
                            <span class="ms-2">{{ $tag->name }}</span><br>
                        </div>
                        <div>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewTagModal{{ $tag->id }}">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editTagModal{{ $tag->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteTagModal{{ $tag->id }}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <!--MODAL PARA VISUALIZAR LAS ETIQUETAS-->
                    <div class="modal fade" id="viewTagModal{{ $tag->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Ver Etiqueta #{{ $tag->id }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <h2>{{ $tag->name }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--MODAL PARA EDITAR-->
                    <div class="modal fade" id="editTagModal{{ $tag->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('tag.update', $tag) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar tarea #{{ $tag->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="title" value="{{ $tag->name }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL PARA ELIMINAR UNA ETIQUETA -->
                    <div class="modal fade" id="deleteTagModal{{ $tag->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('tag.destroy', $tag) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Eliminar tarea #{{ $tag->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Seguro que deseas eliminar la tarea: <strong>{{ $tag->name }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            
        </div>

    </div>
</x-app-layout>