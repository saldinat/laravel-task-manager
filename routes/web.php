<?php

Use App\Task;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/tasks/users', function () {
    // return view('tasks.users');
// });
Route::get('/tasks/users', 'TasksController@users');
Route::get('/tasks', 'TasksController@index');
Route::get('/tasks/create', 'TasksController@create');
Route::post('/tasks','TasksController@store');

Route::patch('/tasks/{task}/complete', 'TasksController@updateStatus');
Route::patch('/tasks/{task}', 'TasksController@reserve');
Route::patch('/tasks/{task}/comment','tasksController@store_comment');
Route::post('/tasks/{task}/comment_2','CommentController@store');
Route::get('/tasks/{task}/edit', 'TasksController@edit');
Route::put('/tasks/{task}/edit', 'TasksController@update');

Route::delete('/tasks/{task}', 'TasksController@destroy');

Route::get('/tasks/{task}', 'TasksController@show');
//Route::get('/tasks/users', 'TasksController@users');


