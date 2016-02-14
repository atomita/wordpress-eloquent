<?php

namespace atomita\wordpress\eloquent\entity;

use \Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use \atomita\wordpress\eloquent\DatabaseManager;

DatabaseManager::bootEloquent();


class PostMeta extends Model {
	/*
	  meta_id, post_id, meta_key, meta_value
	*/

	protected $table = 'postmeta';
	protected $primaryKey = 'meta_id';
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['key', 'value'];


	public function post(){
		return $this->belongsTo(__NAMESPACE__ . '\Post');
	}

	protected function getKeyAttribute(){ return $this->meta_key; }
	protected function setKeyAttribute($v){ $this->meta_key = $v; }
	protected function getValueAttribute(){ return $this->meta_value; }
	protected function setValueAttribute($v){ $this->meta_value = $v; }
}
