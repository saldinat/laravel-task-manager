@extends('layouts.master')
<style>
.page-header{
	margin-top: 80px;
}

</style>
@section('content')

<div class="page-header">
    <h1>Users</h1>      
</div>
	
@foreach (array_filter(array_unique( App\Task::pluck('user_id')->toArray() )) as $t )
<h5>ID {{$t}}:</h5>
<ul>
@foreach(App\Task::where('user_id', $t)->get() as $r)
	<li>
		<h4>{{$r->title}}</h4> <br> {!! $r->body !!} <br>
	</li>
@endforeach
</ul>
<br>
@endforeach
	
@endsection
