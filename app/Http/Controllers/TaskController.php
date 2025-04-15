<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Laravel\Prompts\Note;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::query()
            //->where('id_user',request()->user()->id)
            ->orderBy("created_at", "desc")
            ->paginate();
        return view('task.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'task' => ['required', 'string']
        ]);
        //$data['user_id'] = $request->user()->id;
        $task = Task::create($data);

        return to_route('task.show', $task)->with('message', 'Task was create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //if($task->user_id !==request()->user()->id){
        //   abort(403);
        //}
        return view('task.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
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
       // if($task->user_id !==request()->user()->id){
        //    abort(403);
        //}
        $data = $request->validate([
            'task' => ['required', 'string']
        ]);
        $task->update($data);

        return to_route('task.show', $task)->with('message', 'Task was updated');
    }

    public function destroy(Task $task)
    {
        //if($task->user_id !==request()->user()->id){
        //    abort(403);
        //}
        $task->delete();
        return to_route('task.index')->with('message', 'Task was deleted');
    }
}
