<x-app-layout>
    <form action="{{ route('task.store') }}" method="POST">
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
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}"
                    {{ (isset($task) && $task->tags->contains($tag->id)) ? 'selected' : '' }}>
                    {{ $tag->name }}
                </option>
            @endforeach
        </select>
        
        <button class="btn btn-primary">Agregar tarea</button>
    </form>
</x-app-layout>