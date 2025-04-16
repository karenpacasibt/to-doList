<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Laravel\Prompts\Note;
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
            'selectedCategory' => $request->category_id
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //to-do:validar imput o request
        // $request->validate([
        //     'title' => 'required',
        //     'description' => 'required',
        //     'id_category' => 'nullable|integer',
        // ]);
        return 1;
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->id_category = $request->id_category;
        $task->save();
        return redirect()->route('task.index');
    }

    public function show(Task $task)
    {
        //if($task->user_id !==request()->user()->id){
        //   abort(403);
        //}
        return view('task.show', ['task' => $task]);
    }

    public function edit(Task $task)
    {
        //if($task->user_id !==request()->user()->id){
        //   abort(403);
        //}
        return view('task.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //validar
        //si son lo mismo 
        // $validated = $request->validate([
        //     'title' => 'required|string',
        //     'description' => 'required|string',
        //     'id_category' => 'nullable|integer',
        // ]);
        return 1;
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
        $task->save();
        return redirect()->route('task.index');
    }
    public function destroy(Task $task)
    {
        //if($task->user_id !==request()->user()->id){
        //    abort(403);
        //}
        $task->delete();
        return redirect()->route('task.index');
    }
}
