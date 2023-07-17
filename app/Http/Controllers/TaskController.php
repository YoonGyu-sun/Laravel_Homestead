<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response; // 그냥 바로 웹페이지에 return Response로 보여줄 수 있음.
use Illuminate\View\View; // view페이지 값을 보여주기 위함
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    
    public function index(): View
    {
        return view('tasks.index',[
            'tasks' =>Task::with('user')->latest()->get(),
        ]);
    }

    
    public function create()
    {
        //
    }

 
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $request->user()->tasks()->create($validated);
 
        return redirect(route('tasks.index'));
    }

  
    public function show(Task $task)
    {
        //
    }

    public function edit(Task $task): View
    {
        $this->authorize('update', $task);

        return view('tasks.edit',[
            'task'=>$task,
        ]);
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $this->authorize('update', $task);
 
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $task->update($validated);
 
        return redirect(route('tasks.index'));
    }


    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete',$task);
        $task->delete();
        return redirect(route('tasks.index'));
    }
}
