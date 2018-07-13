<?php use Carbon\Carbon; ?>

@extends('layouts.master')
@section('assets')
    <link rel="stylesheet" href="css/index.css">
@endsection
<style>
.custom{
	width: 42px !important;
}
</style>
@section('content')
<div class="page-header">
    <h1>List of tasks</h1>  
<form action="/tasks/delete_all" method="POST" >
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<div class="form-group">
							<button type="submit" class="btn delete">
								<i class="fa fa-trash-o" aria-hidden="true">Delete all tasks</i>
							</button>
						</div>
					</form>    
</div>
<div class="row">
<div class="col-md-12">
	<div class="progress">
		<div class="progress-bar" role="progressbar" aria-valuenow=" {{ \App\Helpers\AppHelper::progress() }} " aria-valuemin="0" aria-valuemax="100" style="width: {{\App\Helpers\AppHelper::progress()}}%;">
		  {{ \App\Helpers\AppHelper::progress() }}%
		</div>
	</div>
</div>
</div>

<div class="row">
<div class="col-md-4">
<div class="row">
<h3>Assgined</h3>
</div>
@foreach (App\Task::assigned() as $task)
	@if (!$task->completed)
	<div class="row">
		<div class="col-md-8">
			<li>User with id {{$task->user_id}}:  <a href="/tasks/{{$task->id}}">{{ $task->title }}</a> created {{ $task->created_at->diffForHumans()}}</li>
			@if ($task->deadline!= null && $task->deadline->isToday())
				<div class="alert alert-primary">Due today! </div>
			@elseif ($task->deadline!= null && $task->deadline->diffInDays(Carbon::now()) == 0)
				<div class="alert alert-warning">Due tomorrow</div>
			
			@elseif ((App\Task::where('deadline', '<', Carbon::now())->get())->contains($task))
				<div class="alert alert-danger" role="alert">
					Deadline passed {{ date('F d, Y', strtotime($task->deadline)) }}
				</div>
			@endif
		</div>
		<div class="col-md-4">
			<form action="/tasks/{{ $task->id }}/complete" method="POST" class="form-inline">
				{{ csrf_field() }}
				{{ method_field('PATCH') }}
				<div class="form-group">
					<button type="submit" class="btn">
						<i class="fa {{ $task->completed?'fa-undo':'fa-check' }} " aria-hidden="true"></i>
					</button>
				</div>
			</form>
			<form action="/tasks/{{ $task->id }}" method="POST">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}
				<button type="submit" class="btn delete custom">
					<i class="fa fa-trash-o" aria-hidden="true"></i>
				</button>
			</form>
		</div>	
	</div>
	@endif	
@endforeach
</div>	

<div class="col-md-4">
@if (count(App\Task::unassigned()) > 0)
	<div class="row">
		<h3>Free to-choose</h3>
	</div>
	@foreach (App\Task::unassigned() as $task)
		@if (!$task->completed)
			<div class="row">
				<div class="col-md-9">
					<li><a href="/tasks/{{$task->id}}">{{ $task->title }}</a> created {{ $task->created_at->diffForHumans()}}</li>
					@if ($task->deadline!= null && $task->deadline->isToday())
						<div class="alert alert-primary">Due today! </div>
					@elseif ($task->deadline!= null && $task->deadline->diffInDays(Carbon::now()) == 0)
						<div class="alert alert-warning">Due tomorrow</div>
					@elseif ((App\Task::where('deadline', '<', Carbon::now())->get())->contains($task))
						<div class="alert alert-danger" role="alert">
					Deadline passed {{ date('F d, Y', strtotime($task->deadline)) }}
				</div>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<form action="/tasks/{{ $task->id }}" method="POST" class="form-inline" >
						{{ csrf_field() }}
						{{ method_field('PATCH') }}
						<div class="form-group">
							<input class="form-control id-field" placeholder="Your id" 
								name="user_id" type="text" value="{{ $task->reserved_by?$task->reserved_by:null }}">
							</input>
							<button type="submit" class="btn">
								Reserve
							</button>
						</div>
					</form>
				</div>
				<div class="col-md-6">
					<form action="/tasks/{{ $task->id }}" method="POST" >
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<div class="form-group">
							<button type="submit" class="btn delete custom">
								<i class="fa fa-trash-o" aria-hidden="true"></i>
							</button>
						</div>
					</form>
				</div>
			</div>
			
		@endif
	@endforeach
	@endif
	@if (App\Task::count_reserved() > 0)
	<div class="row">
		<h3>Reserved</h3>
	</div>
	@foreach (App\Task::reserved() as $task)
	@if (!$task->completed)
	<div class="row">
		<div class="col-md-8">
			<li><a href="/tasks/{{$task->id}}">{{ $task->title }}</a> reserved by user #{{ $task->reserved_by }} {{ $task->updated_at->diffForHumans()}}</li>
			@if ($task->deadline!= null && $task->deadline->isToday())
				<div class="alert alert-primary">Due today! </div>
			@elseif ($task->deadline!= null && $task->deadline->diffInDays(Carbon::now()) == 0)
				<div class="alert alert-warning">Due tomorrow</div>
			@elseif ((App\Task::where('deadline', '<', Carbon::now())->get())->contains($task))
				<div class="alert alert-danger" role="alert">
					Deadline passed {{ date('F d, Y', strtotime($task->deadline)) }}
				</div>
			@endif
		</div>
	
		<div class="col-md-4">				
		<form action="/tasks/{{ $task->id }}/complete" method="POST" class="form-inline">
		{{ csrf_field() }}
		{{ method_field('PATCH') }}
		<div class="form-group">
		<button type="submit" class="btn">
		<i class="fa {{ $task->completed?'fa-undo':'fa-check' }} " aria-hidden="true"></i>
		</button>
		</div>
		</form>
		<form action="/tasks/{{ $task->id }}" method="POST" class="form-inline">
		{{ csrf_field() }}
		{{ method_field('DELETE') }}
		<button type="submit" class="btn delete custom">
		<i class="fa fa-trash-o" aria-hidden="true"></i>
		</button>
		</form>
		</div></div>
	

	
	@endif
	@endforeach
	@endif
</div>	
<div class="col-md-4">
	<div class="row">
		<h3>Done</h3>
	</div>
	@foreach ($tasks as $task)
	@if ($task->completed)
	<div class="row">
		<div class="col-md-8">
			<li> @if ($task->user_id) User with id {{$task->user_id}}: @endif <a href="/tasks/{{$task->id}}">{{ $task->title }}</a> completed {{ $task->updated_at->diffForHumans()}}
			</li>
		</div>
		<div class="col-md-4">
			<form action="/tasks/{{ $task->id }}/complete" method="POST" class="form-inline">
				{{ csrf_field() }}
				{{ method_field('PATCH') }}
				<div class="form-group">
					<button type="submit" class="btn">
						<i class="fa {{ $task->completed?'fa-undo':'fa-check' }} " aria-hidden="true"></i>
					</button>
				</div>
			</form>
			<form action="/tasks/{{ $task->id }}" method="POST">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}
				<button type="submit" class="btn delete custom">
					<i class="fa fa-trash-o" aria-hidden="true"></i>
				</button>
			</form>
			
		</div>
	</div>
	
	@endif
	@endforeach
</div>	

</div>

@endsection
