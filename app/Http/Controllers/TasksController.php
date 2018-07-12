<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Task;
use App\Comment;
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
	public function store(Request $request, Task $task) {
		$this->validate(request(), [
			'title' => 'required'	
		]);
		//Task::create(request(['user_id', 'title', 'body', 'deadline'])); whyyyyyy
		$task = new Task;
        $task->user_id = $request->user_id;
		$task->title = $request->title;
		$task->body = $request->body;
		$task->deadline = Carbon::parse($task->deadline);
        $task->save();
		return redirect('/tasks');
	}
	// public function store_comment(Request $request, Task $task) {
 		// $this->validate(request(), [
			// 'comment' => 'required'
		// ]); 
		// $task->comments .= request('comment')."#";
		// $task->save();
		// return view('tasks.show', compact('task'));
	// }
	
	public function edit(Task $task)
    {
        return view('tasks.edit')
            ->with('task', $task);
    }
	public function updateStatus(Request $request, Task $task)
    {
        $task->completed = !$task->completed;
		if($task->reserved_by) {
			$task->user_id = $task->reserved_by;
			$task->reserved_by = null;
		}
        $task->save();
        return redirect('/tasks');
    }
	public function reserve(Request $request, Task $task)
    {
		$task->reserved_by = request('user_id');
        $task->save();
        return redirect('/tasks');
    }
	public function update(Request $request, Task $task)
    {
		$task->title = request('title');
		$task->body = request('body');
		$task->user_id = request('user_id');
		$task->deadline = Carbon::parse($request->deadline);
        $task->save();
        return redirect('/tasks');
    }
	public function destroy(Task $task)
    {
    	$task->delete();
    	return redirect('/tasks');
    }
	public function delete_all()
    {
    	Task::query()->truncate();
		Comment::query()->truncate();
    	return redirect('/tasks');
    }
	public function users()
    {
    	
    	return view('tasks.users');
    }
}
