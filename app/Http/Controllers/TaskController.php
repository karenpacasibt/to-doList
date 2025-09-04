<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        $query = Task::query();
        if ($request->has('id_category') && $request->id_category !== '') {
            $query->where('id_category', $request->id_category);
        }

        $tasks = Task::query()
            ->orderBy("created_at")
            ->paginate();
        $categories = Category::all();
        return view('task.index', [
            'tasks' => $tasks,
            'categories' => $categories,
            'id_category' => $request->id_category,
            'tags' => Tag::all(),
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('task.create', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'id_category' => 'nullable|integer',
            'status' => 'nullable|boolean',
            'tags' => 'array',
            'tags.*' => 'integer|exists:tags,id',
        ]);
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->id_category = $request->id_category;
        $task->status = $request->has('status');
        $task->save();
        if ($request->has('tags')) {
            $task->tags()->attach($request->tags);
        }
        return redirect()->route('task.index');
    }

    public function show(Task $task)
    {
        return view('task.show', ['task' => $task]);
    }

    public function edit(Task $task)
    {
        $tags = Tag::all();
        $categories = Category::all();
        $task->load('tags');
        return view('task.edit', compact('task', 'tags', 'categories'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'id_category' => 'nullable|integer',
            'status' => 'nullable|boolean',
            'tags' => 'array',
            'tags.*' => 'integer|exists:tags,id',
        ]);

        $currentTagIds = $task->tags->pluck('id')->sort()->values();
        $newTagIds = collect($validated['tags'] ?? [])->sort()->values();

        if (
            $task->title === $validated['title'] &&
            $task->description === $validated['description'] &&
            $task->id_category == $validated['id_category'] &&
            $currentTagIds->diff($newTagIds)->isEmpty() &&
            $newTagIds->diff($currentTagIds)->isEmpty()
        ) {
            // Nada cambió → no guardamos
            return back()->with('info', 'No se detectaron cambios.');
        }

        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'id_category' => $validated['id_category'],
        ]);

        $task->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('task.index')->with('success', 'Tarea actualizada correctamente.');
    }

    public function destroy(Task $task)
    {
        $task->tags()->detach();
        $task->delete();
        return $task;
    }
    public function updateStatus(Request $request, Task $task)
    {
        $validated = $request->validate([
            'status' => 'required|boolean',
        ]);
        $task->status = $validated['status'];
        $task->save();
        return response()->json(['success' => true]);
    }
}
