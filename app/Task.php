<?php

namespace App;



class Task extends Model
{
	
    public static function incomplete() {
		return static::where('completed', '0')->get();
	}
	public static function unassigned() {
		return static::where('user_id', null)->get();
	}
	public static function assigned() {
		return static::whereNotNull('user_id')->get();
	}
}
