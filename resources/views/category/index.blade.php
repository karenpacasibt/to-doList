<x-app-layout>
    <div class="container py-4">
        <div class="card p-4 shadow-sm">
            <form action="{{ route('category.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Title" name="title" required>
                </div>
                <div class="mb-3">
                    <textarea class="form-control" placeholder="Description" name="description" required></textarea>
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
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewcategoryModal{{ $category->id }}">Ver</button>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editcategoryModal{{ $category->id }}">Editar</button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletecategoryModal{{ $category->id }}">Eliminar</button>
                        </div>
                    </div>
                @endforeach
            
        </div>

    </div>
</x-app-layout>