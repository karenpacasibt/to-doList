<x-app-layout>
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6">
        <form action="{{ route('task.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Título:</label>
                <input type="text" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Title" name="title">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Descripción:</label>
                <textarea class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Description" name="description"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Selecciona una categoría:</label>
                <select name="id_category" class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Selecciona una categoría</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Seleccione etiquetas:</label>
                <select id="tags-select" name="tags[]" multiple class="w-full border-gray-300 rounded-md shadow-sm">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}"
                            {{ (isset($task) && $task->tags->contains($tag->id)) ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end space-x-4 mt-6">
                <a class="btn btn-danger" href="{{route('task.index')}}" role="button">Cancelar</a>
                <button class="btn btn-primary">Agregar tarea</button>
            </div>
            </div>
        </form>
    </div>
    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                new TomSelect("#tags-select", {
                    plugins: ['remove_button'],
                    placeholder: "Selecciona etiquetas...",
                    persist: false,
                    create: false,
                    maxItems: null,
                    allowEmptyOption: true,
                    render: {
                        option: function(data, escape) {
                            return `<div class="option">${escape(data.text)}</div>`;
                        }
                    }
                });
            });
        </script>
    @endsection
</x-app-layout>