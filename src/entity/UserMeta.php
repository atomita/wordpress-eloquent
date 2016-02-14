<?php

namespace atomita\wordpress\eloquent\entity;

use \Illuminate\Database\Eloquent\Model;
use \atomita\wordpress\eloquent\DatabaseManager;

DatabaseManager::bootEloquent();


class UserMeta extends Model {
	/*
	  umeta_id, user_id, meta_key, meta_value
	*/

	protected $table = 'usermeta';
	protected $primaryKey = 'umeta_id';
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['key', 'value'];


	public function user(){
		return $this->belongsTo(__NAMESPACE__ . '\User');
	}

	protected function getKeyAttribute(){ return $this->meta_key; }
	protected function setKeyAttribute($v){ $this->meta_key = $v; }
	protected function getValueAttribute(){ return $this->meta_value; }
	protected function setValueAttribute($v){ $this->meta_value = $v; }
}
