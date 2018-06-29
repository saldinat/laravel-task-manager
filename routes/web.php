<?php

Use App\Task;

Route::get('/tasks', 'TasksController@index');
Route::get('/tasks/create', 'TasksController@create');
Route::post('/tasks','tasksController@store');

Route::patch('/tasks/{task}', 'TasksController@updateStatus');

Route::get('/tasks/{task}/edit', 'TasksController@edit');
Route::put('/tasks/{task}/edit', 'TasksController@update');

Route::delete('/tasks/{task}', 'TasksController@destroy');

Route::get('/tasks/{task}', 'TasksController@show');

