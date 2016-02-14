<?php

namespace atomita\wordpress\eloquent\entity;

use \Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use \atomita\wordpress\eloquent\DatabaseManager;

DatabaseManager::bootEloquent();


class User extends Model {
	use traits\Metable;

	protected $table = 'users';
	protected $primaryKey = 'ID';
	public $timestamps = false;

	/**
	 * The name of the "created at" column.
	 *
	 * @var string
	 */
	const CREATED_AT = 'user_registered';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [];


	public function metas(){
		return $this->hasMany(__NAMESPACE__ . '\UserMeta');
	}

	public function posts(){
		return $this->hasMany(__NAMESPACE__ . '\Post', 'post_author');
	}

	public function comments(){
		return $this->hasMany(__NAMESPACE__ . '\Comment');
	}


	public function getColumnNames(){
		return [
			'ID', 'user_login', 'user_pass', 'user_nicename', 'user_email', 'user_url',
			'user_registered', 'user_activation_key', 'user_status', 'display_name'
		];
	}

	protected function getLoginAttribute(){ return $this->user_login; }
	protected function setLoginAttribute($v){ $this->user_login = $v; }
	protected function getPassAttribute(){ return $this->user_pass; }
	protected function setPassAttribute($v){ $this->user_pass = $v; }
	protected function getNicenameAttribute(){ return $this->user_nicename; }
	protected function setNicenameAttribute($v){ $this->user_nicename = $v; }
	protected function getEmailAttribute(){ return $this->user_email; }
	protected function setEmailAttribute($v){ $this->user_email = $v; }
	protected function getUrlAttribute(){ return $this->user_url; }
	protected function setUrlAttribute($v){ $this->user_url = $v; }
	protected function getRegisteredAttribute(){ return $this->user_registered; }
	protected function setRegisteredAttribute($v){ $this->user_registered = $v; }
	protected function getActivationKeyAttribute(){ return $this->user_activation_key; }
	protected function setActivationKeyAttribute($v){ $this->user_activation_key = $v; }
	protected function getStatusAttribute(){ return $this->user_status; }
	protected function setStatusAttribute($v){ $this->user_status = $v; }

}


User::creating(function($record){
	if (! $record->isDirty(User::CREATED_AT)) {
		$record->setCreatedAt($record->freshTimestamp());
	}
});
