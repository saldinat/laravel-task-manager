@extends('layouts.master')

@section ('content')
<div class='col-sm-8'>
	<h1>Create a task </h1>
	
	<form method="POST" action="/tasks">
		{{ csrf_field() }}
		<div class="form-group">
		<label for="user_id">For user with id:</label>
		<input  type="text" class="form-control" id="user_id" name="user_id" placeholder="Leave blank if anyone can choose that task">
	  </div>
	  <div class="form-group">
		<label for="title">Title</label>
		<textarea  class="form-control" id="title" name="title" ></textarea>
	  </div>
	  <div class="form-group">
		
		<textarea id="summernote" name="body" ></textarea>
		
	  </div>
    
	  <button type="submit" class="btn btn-default">Publish</button>
	</form>
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
        height: 600
      });
});
</script>