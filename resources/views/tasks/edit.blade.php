@extends('layouts.master')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<style>
.page-header{
	margin-top: 80px;
}
</style>
@section ('content')

  <div class="row">
<div class='col-sm-8'>
	<div class="page-header">
    <h1>Edit a task</h1>      
  </div>
	  
	<form method="POST" action="/tasks/{{ $task->id }}/edit">
		{{ csrf_field() }}
		{{ method_field('put') }}
		<div class="form-group">
		<label for="user_id">For user with id:</label>
		<input  value="{{$task->user_id}}" type="text" class="form-control" id="user_id" name="user_id" placeholder="Leave blank if anyone can choose that task"></input>
		</div>
		<div class="form-group">
		<label for="title">Title:</label>
		<input  value="{{$task->title}}" type="text" class="form-control" id="title" name="title" >
		</div>
		
		    
	  
	  <div class="form-group">
		
		<textarea id="summernote" name="body" >{{{$task->body}}}</textarea>
		
	  </div>
	  <div class="form-group">
		<label for="deadline">Deadline:</label>
		{!! Form::text('deadline', '', array('id' => 'datepicker', 'class'=>'form-control', 'style'=>'width: 300px;', 'placeholder'=>'Leave blank if deadline is flexible') ) !!}
		</div>
    
	  <button type="submit" class="btn btn-default">Save</button>
	</form>
<div class="form-group">
	@extends('layouts.errors')
</div>
	</div>
	</div>
@endsection
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
	
  <script>
  
  </script>
<script>
$(function() {
    $( "#datepicker" ).datepicker( );
  });
$(document).ready(function() {
  
  $('#summernote').summernote({
        placeholder: 'Body',
        tabsize: 2,
        height: 300
      });

});
</script>