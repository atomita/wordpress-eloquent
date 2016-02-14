<?php

namespace atomita\wordpress\eloquent\entity;

use \Illuminate\Database\Eloquent\Model;
use \atomita\wordpress\eloquent\DatabaseManager;

DatabaseManager::bootEloquent();


class Option extends Model {
	/*
	  option_id, option_name, option_value, autoload
	*/

	protected $table = 'options';
	protected $primaryKey = 'option_id';
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'option_name', 'option_value', 'autoload'
	];
}


Option::saving(function($option){
	$autoload = $option->autoload;
	if (is_null($autoload) ||
		$autoload === true ||
		(is_string($autoload) && (strtolower($autoload) == 'yes' || strtolower($autoload) == 'y'))){
		$option->autoload = 'yes';
	}
	else{
		$option->autoload = 'no';
	}
});
