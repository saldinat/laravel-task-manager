@extends('layouts.master')
<style>
.page-header{
	margin-top: 80px;
}
.user_name{
    font-size:14px;
    font-weight: bold;
}
.comments-list .media{
    border-bottom: 1px dotted #ccc;
}
.comment{
	border-bottom: 1px dotted grey;
}
</style>
@section('content')

<div class="row">
	<div class="col-md-12">
	<div class="page-header">
    <h1>Task #{{$task->id}}</h1>   
</div>
		   
		<h2>{{ $task->title }} @if($task->deadline) <small>Deadline: {{ date('F d, Y', strtotime($task->deadline)) }}</small> @endif</h2>
		
		{!! $task->body !!}
		<br>
		
		<a class="btn btn-default" href="/tasks/{{ $task->id }}/edit">Edit</a>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<h3>{{ count($task->comments) }} Comments</h3> 
		<form action="/tasks/{{ $task->id }}/comment_2" class="form-group" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<textarea id="summernote" name="body"></textarea>
			</div>
			<button type="submit" class="btn">
				Publish
			</button>
		</form>
	</div>
	
</div>


@foreach ($task->comments as $comment)
		<div class="row">
		<div class="col-md-8 comment">
			<h5>user <small>{{ $comment->created_at->diffForHumans()}}</small></h5>
				{!! $comment->body !!}
		</div>
		</div>
		@endforeach
	
		
	
	<div class="form-group">
	@include('layouts.errors')
</div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
$(document).ready(function() {
  
  $('#summernote').summernote({
        placeholder: 'Body',
        tabsize: 2,
        height: 200
      });
});
</script>