@extends('layouts.master')
@section('content')
<div class="row">
<div class="col-lg-12">
	<div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow=" {{ \App\Helpers\AppHelper::progress() }} " aria-valuemin="0" aria-valuemax="100" style="width: {{\App\Helpers\AppHelper::progress()}}%;">
	  {{ \App\Helpers\AppHelper::progress() }}%
  </div>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-4">
<h3>Assgined tasks</h3>
@foreach (App\Task::assigned() as $task)
@if (!$task->completed)
				<li>User with id {{$task->user_id}}:  <a href="/tasks/{{$task->id}}">{{ $task->title }}</a> created {{ $task->created_at->diffForHumans()}}
				
					<form action="/tasks/{{ $task->id }}" method="POST" class="form-inline">
						{{ csrf_field() }}
						{{ method_field('PATCH') }}
						
						<div class="form-group">
						<input class="form-control" placeholder="Wanna do it? Put your id!" name="user_id" type="text" value="{{ $task->user_id?$task->user_id:null }}">
							
						</input>
						<button type="submit" class="btn {{ $task->completed?'btn-success':'btn-danger' }} ">
							{{ $task->completed?'Undo':'Do it' }}
						</button>
						</div>
					</form>
					
					<form action="/tasks/{{ $task->id }}" method="POST">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button type="submit" class="btn">
							Delete
						</button>
					</form>
				</li>
			@endif	
			@endforeach
</div>	

<div class="col-lg-4">
<h3>Free to-choose tasks</h3>
@foreach (App\Task::unassigned() as $task)
@if (!$task->completed)
				<li>User with id {{$task->user_id}}:  <a href="/tasks/{{$task->id}}">{{ $task->title }}</a> created {{ $task->created_at->diffForHumans()}}
				
					<form action="/tasks/{{ $task->id }}" method="POST" class="form-inline">
						{{ csrf_field() }}
						{{ method_field('PATCH') }}
						
						<div class="form-group">
						<input class="form-control" placeholder="Wanna do it? Put your id!" 
name="user_id" type="text" value="{{ $task->user_id?$task->user_id:null }}">
							
						</input>
						<button type="submit" class="btn {{ $task->completed?'btn-success':'btn-danger' }} ">
							{{ $task->completed?'Undo':'Do it' }}
						</button>
						</div>
					</form>
					
					<form action="/tasks/{{ $task->id }}" method="POST" class="form-inline">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button type="submit" class="btn">
							Delete
						</button>
					</form>
				</li>
				@endif
			@endforeach
</div>	
<div class="col-lg-4">
<h3>Done</h3>
@foreach ($tasks as $task)
@if ($task->completed)
				<li>User with id {{$task->user_id}}:  <a href="/tasks/{{$task->id}}">{{ $task->title }}</a> created {{ $task->created_at->diffForHumans()}}
				
					<form action="/tasks/{{ $task->id }}" method="POST" class="form-inline">
						{{ csrf_field() }}
						{{ method_field('PATCH') }}
						<div class="form-group">
						<button type="submit" class="btn {{ $task->completed?'btn-success':'btn-danger' }} ">
							{{ $task->completed?'Undo':'Do it' }}
						</button>
						</div>
					</form>
					<form action="/tasks/{{ $task->id }}" method="POST">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button type="submit" class="btn">
							Delete
						</button>
					</form>
				</li>
				@endif
			@endforeach
</div>	

</div>
@endsection
