<?php

namespace App;



class Task extends Model
{
	protected $dates = ['deadline'];

	public function comments()
	{
	  return $this->hasMany('App\Comment');
	}
	
    public static function incomplete() {
		return static::where('completed', '0')->latest()->get();
	}
	public static function unassigned() {
		return static::where([
			['user_id', null],
			['reserved_by', null],
		])->latest()->get();
	}
	
	
	public static function assigned() {
		return static::whereNotNull('user_id')->latest()->get();
	}
	public static function reserved() {
		return static::whereNotNull('reserved_by')->latest()->get();
	}
	public static function count_reserved() {
		return static::whereNotNull('reserved_by')->count();
	}
}
