<?php
namespace App\Helpers;
use App\Task;
class AppHelper
{
	public static function progress()
	{	
		if(Task::count() != 0)
			return round((Task::where('completed','=','1')->count()) * 100 /  Task::count());
		else return 0;
	}

    
}