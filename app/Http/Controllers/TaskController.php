<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = Task::query();
        if ($request->has('id_category') && $request->id_category !== '') {
            $query->where('id_category', $request->id_category);
        }

        $tasks = Task::query()
            //->where('id_user',request()->user()->id)
            ->orderBy("created_at")
            ->paginate();
        $categories = Category::all();
        return view('task.index', [
            'tasks' => $tasks,
            'categories' => $categories,
            'selectedCategory' => $request->category_id,
            'tags'=>Tag::all(),
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('task.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //to-do:validar imput o request
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

        //para la relacion de tags con task many to many
        if( $request->has('tags')){
            $task ->tags()->attach( $request->tags );
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
        $task->load('tags');
        return view('task.edit', compact('task', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
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
        
        if (
            $task->title === $validated['title'] &&
            $task->description === $validated['description'] &&
            $task->id_category == $validated['id_category']
        ) {
            return back();
        }
        $task->title = $request->title;
        $task->description = $request->description;
        $task->id_category = $request->id_category;
        $task->status = $request->has('status');
        $task->save();

        $task->tags()->sync($request->tags ?? []);

        return redirect()->route('task.index');
    }
    public function destroy(Task $task)
    {
        $task->tags()->detach();
        $task->delete();
        return redirect()->route('task.index');
    }
}
