<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }
    public function index(Request $request)
    {
        $query = Task::with(['category', 'tags']);
        if ($request->filled('id_category')) {
            $query->where('id_category', $request->id_category);
        }
        $tasks = $query->paginate(8);
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:tasks,title',
            'description' => 'required|string',
            'id_category' => 'nullable|integer|exists:tags,id',
            'status' => 'nullable|boolean',
            'tags' => 'array',
            'tags.*' => 'integer|exists:tags,id',
        ]);
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->id_category = $request->id_category;
        $task->user_id = auth()->id();
        $task->status = $request->boolean('status');
        $task->save();

        if ($request->has('tags')) {
            $task->tags()->attach($request->tags);
        }

        $task->load(['category', 'tags']);

        return response()->json(['data' => $task], 200);
    }

    public function show($id)
    {
        $task = Task::with(['category', 'tags'])->findOrFail($id);
        return response()->json(['data' => $task]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => [
                'string',
                Rule::unique('tasks')->ignore($id)
            ],
            'description' => 'string',
            'id_category' => 'nullable|integer',
            'status' => 'sometimes|nullable|boolean',
            'tags' => 'array',
            'tags.*' => 'integer|exists:tags,id',
        ]);
        $task = Task::findOrFail($id);
        if ($request->has('title'))
            $task->title = $request->title;
        if ($request->has('description'))
            $task->description = $request->description;
        if ($request->has('id_category'))
            $task->id_category = $request->id_category;
        if ($request->has('status'))
            $task->update($request->only('status'));
        $task->save();
        if ($request->has('tags')) {
            $task->tags()->sync($request->tags);
        }

        $task = Task::with(['category', 'tags'])->find($task->id);
        return response()->json(['data' => $task]);
    }

    public function destroy($id)
    {
        $task = Task::with(['category', 'tags'])->findOrFail($id);
        $task->delete();
        return response()->json(['data' => $task]);
    }
}
