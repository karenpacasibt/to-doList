<x-app-layout>
    <div class="container py-4">
        <div class="card p-4 shadow-sm">
            <form action="{{ route('category.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Title" name="name" required>
                </div>
                <button class="btn btn-primary">Agregar categoria</button>
            </form>
            
                @foreach ($categories as $category)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <div>
                            <strong>{{ $category->id }}</strong>
                            <span class="ms-2">{{ $category->name }}</span><br>
                        </div>
                        <div>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewCategoryModal{{ $category->id }}"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal{{ $category->id }}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <!--MODAL PARA VISUALIZAR LA CATEGORIA-->
                    <div class="modal fade" id="viewCategoryModal{{ $category->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Ver Etiqueta #{{ $category->id }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <h2>{{ $category->name }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--MODAL PARA EDITAR-->
                    <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('category.update', $category) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar tarea #{{ $category->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="name" value="{{ $category->name }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL PARA ELIMINAR UNA CATEGORIA-->
                    <div class="modal fade" id="deleteCategoryModal{{ $category->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('category.destroy', $category) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Eliminar tarea #{{ $category->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Seguro que deseas eliminar la tarea: <strong>{{ $category->name }}</strong>?
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