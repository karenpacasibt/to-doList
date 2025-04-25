<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::with(['category', 'tags']);
        if ($request->filled('id_category')) {
            $query->where('id_category', $request->id_category);
        }
        $tasks = $query->paginate(10);
        return response()->json(['data' => $tasks]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
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
        $task->status = $request->boolean('status');
        $task->save();

        if ($request->has('tags')) {
            $task->tags()->attach($request->tags);
        }

        $task->load(['category', 'tags']);

        return response()->json(['data' => $task], 201);
    }

    public function show($id)
    {
        $task = Task::with(['category', 'tags'])->findOrFail($id);
        return response()->json(['data' => $task]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'id_category' => 'nullable|integer',
            'status' => 'nullable|boolean',
            'tags' => 'array',
            'tags.*' => 'integer|exists:tags,id',
        ]);
        $task = Task::findOrFail($id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->id_category = $request->id_category;
        $task->status = $request->boolean('status');
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
