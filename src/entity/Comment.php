<?php

namespace atomita\wordpress\eloquent\entity;

use \Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use \atomita\wordpress\eloquent\DatabaseManager;

DatabaseManager::bootEloquent();


class Comment extends Model {
	use traits\Metable;

	protected $table = 'comments';
	protected $primaryKey = 'comment_ID';
	public $timestamps = false;

	/**
	 * The name of the "created at" column.
	 *
	 * @var string
	 */
	const CREATED_AT = 'comment_date';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [];


	public function metas(){
		return $this->hasMany(__NAMESPACE__ . '\CommentMeta');
	}

	public function user(){
		return $this->belongsTo(__NAMESPACE__ . '\User');
	}

	public function post(){
		return $this->belongsTo(__NAMESPACE__ . '\Post', 'comment_post_ID');
	}

	public function getColumnNames(){
		return [
			'comment_ID', 'comment_post_id', 'comment_author', 'comment_author_email',
			'comment_author_url', 'comment_author_IP', 'comment_date', 'comment_date_gmt',
			'comment_content', 'comment_karma', 'comment_approved', 'comment_agent',
			'comment_type', 'comment_parent', 'user_id'
		];
	}


	protected function getAuthorAttribute(){ return $this->comment_author; }
	protected function setAuthorAttribute($v){ $this->comment_author = $v; }
	protected function getAuthorEmailAttribute(){ return $this->comment_author_email; }
	protected function setAuthorEmailAttribute($v){ $this->comment_author_email = $v; }
	protected function getAuthorUrlAttribute(){ return $this->comment_author_url; }
	protected function setAuthorUrlAttribute($v){ $this->comment_author_url = $v; }
	protected function getAuthorIPAttribute(){ return $this->comment_author_IP; }
	protected function setAuthorIPAttribute($v){ $this->comment_author_IP = $v; }
	protected function getDateAttribute(){ return $this->comment_date; }
	protected function setDateAttribute($v){ $this->comment_date = $v; }
	protected function getDateGmtAttribute(){ return $this->comment_date_gmt; }
	protected function setDateGmtAttribute($v){ $this->comment_date_gmt = $v; }
	protected function getContentAttribute(){ return $this->comment_content; }
	protected function setContentAttribute($v){ $this->comment_content = $v; }
	protected function getKarmaAttribute(){ return $this->comment_karma; }
	protected function setKarmaAttribute($v){ $this->comment_karma = $v; }
	protected function getApprovedAttribute(){ return $this->comment_approved; }
	protected function setApprovedAttribute($v){ $this->comment_approved = $v; }
	protected function getAgentAttribute(){ return $this->comment_agent; }
	protected function setAgentAttribute($v){ $this->comment_agent = $v; }
	protected function getTypeAttribute(){ return $this->comment_type; }
	protected function setTypeAttribute($v){ $this->comment_type = $v; }
	protected function getParentAttribute(){ return $this->comment_parent; }
	protected function setParentAttribute($v){ $this->comment_parent = $v; }

}

Comment::creating(function($record){
	if (! $record->isDirty(Comment::CREATED_AT)) {
		$record->setCreatedAt($record->freshTimestamp());
	}
	if (! $record->isDirty('comment_date_gmt')) {
		$record->comment_date_gmt = new Carbon(null, 'GMT');
	}
});
