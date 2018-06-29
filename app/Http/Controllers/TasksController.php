<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
class TasksController extends Controller
{
    public function index() {
		$tasks = Task::latest()->get();
		return view('tasks.index', compact('tasks'));
	}
	public function show(Task $task) {
		return view('tasks.show', compact('task'));
	}
	public function create() {
		return view('tasks.create');
	}
	public function store() {
		$this->validate(request(), [
			
			'title' => 'required'
		]);
		Task::create(request(['user_id', 'title', 'body']));
		return redirect('/tasks');
	}
	public function edit(Task $task)
    {
        return view('tasks.edit')
            ->with('task', $task);
    }
	public function updateStatus(Request $request, Task $task)
    {
		//$task->body = request('body');
		//$task->body = request('body');
        $task->completed = !$task->completed;
		$task->user_id = request('user_id');
        $task->save();
        return redirect('/tasks');
    }
	public function update(Request $request, Task $task)
    {
		$task->title = request('title');
		$task->body = request('body');
        $task->completed = !$task->completed;
		$task->user_id = request('user_id');
        $task->save();
        return redirect('/tasks');
    }
	public function destroy(Task $task)
    {
    	$task->delete();
    	return redirect('/tasks');
    }
}
