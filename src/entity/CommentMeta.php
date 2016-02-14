<?php

namespace atomita\wordpress\eloquent\entity;

use \Illuminate\Database\Eloquent\Model;
use \atomita\wordpress\eloquent\DatabaseManager;

DatabaseManager::bootEloquent();


class CommentMeta extends Model {
	/*
	  meta_id, comment_id, meta_key, meta_value
	*/

	protected $table = 'commentmeta';
	protected $primaryKey = 'meta_id';
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['key', 'value'];


	public function comment(){
		return $this->belongsTo(__NAMESPACE__ . '\Comment');
	}

	protected function getKeyAttribute(){
		return $this->meta_key;
	}

	protected function setKeyAttribute($value){
		$this->meta_key = $value;
	}

	protected function getValueAttribute(){
		return $this->meta_value;
	}

	protected function setValueAttribute($value){
		$this->meta_value = $value;
	}
}
