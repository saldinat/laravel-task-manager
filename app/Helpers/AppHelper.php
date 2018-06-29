<?php
namespace App\Helpers;
use App\Task;
class AppHelper
{
	public static function progress()
	{
		return round((Task::where('completed','=','1')->count()) * 100 /  Task::count());
	}

    
}