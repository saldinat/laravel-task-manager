@extends('layouts.master')
@section('content')
<h1>A task</h1>
	{{ $task->title }}
	{!! $task->body !!}
	<br>
	<a class="btn btn-primary" href="/tasks/{{ $task->id }}/edit">Edit</a>
@endsection