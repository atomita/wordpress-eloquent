<?php

namespace atomita\wordpress\eloquent\entity;

use \Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use \atomita\wordpress\eloquent\DatabaseManager;

DatabaseManager::bootEloquent();


class Post extends Model {
	use traits\Metable;

	protected $table = 'posts';
	protected $primaryKey = 'ID';

	/**
	 * The name of the "created at" column.
	 *
	 * @var string
	 */
	const CREATED_AT = 'post_date';
	/**
	 * The name of the "updated at" column.
	 *
	 * @var string
	 */
	const UPDATED_AT = 'post_modified';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [];


	public function metas(){
		return $this->hasMany(__NAMESPACE__ . '\PostMeta');
	}

	public function user(){
		return $this->belongsTo(__NAMESPACE__ . '\User', 'post_author');
	}

	public function comments(){
		return $this->hasMany(__NAMESPACE__ . '\Comment', 'comment_post_id');
	}

	public function term_taxonomies(){
		return $this->belongsToMany(__NAMESPACE__ . '\TermTaxonomy',
									'term_relationships',
									'object_id',
									'term_taxonomy_id')
					->withPivot('term_order');
	}

	public function getColumnNames(){
		return [
			'ID', 'post_author', 'post_date', 'post_date_gmt', 'post_content',
			'post_title', 'post_excerpt', 'post_status', 'comment_status',
			'ping_status', 'post_password', 'post_name', 'to_ping', 'pinged',
			'post_modified', 'post_modified_gmt', 'post_content_filtered',
			'post_parent', 'guid', 'menu_order', 'post_type', 'post_mime_type',
			'comment_count'
		];
	}


	protected function getAuthorAttribute(){ return $this->post_author; }
	protected function setAuthorAttribute($v){ $this->post_author = $v; }
	protected function getDateAttribute(){ return $this->post_date; }
	protected function setDateAttribute($v){ $this->post_date = $v; }
	protected function getDateGmtAttribute(){ return $this->post_date_gmt; }
	protected function setDateGmtAttribute($v){ $this->post_date_gmt = $v; }
	protected function getContentAttribute(){ return $this->post_content; }
	protected function setContentAttribute($v){ $this->post_content = $v; }
	protected function getTitleAttribute(){ return $this->post_title; }
	protected function setTitleAttribute($v){ $this->post_title = $v; }
	protected function getExcerptAttribute(){ return $this->post_excerpt; }
	protected function setExcerptAttribute($v){ $this->post_excerpt = $v; }
	protected function getStatusAttribute(){ return $this->post_status; }
	protected function setStatusAttribute($v){ $this->post_status = $v; }
	protected function getPasswordAttribute(){ return $this->post_password; }
	protected function setPasswordAttribute($v){ $this->post_password = $v; }
	protected function getNameAttribute(){ return $this->post_name; }
	protected function setNameAttribute($v){ $this->post_name = $v; }
	protected function getModifiedAttribute(){ return $this->post_modified; }
	protected function setModifiedAttribute($v){ $this->post_modified = $v; }
	protected function getModifiedGmtAttribute(){ return $this->post_modified_gmt; }
	protected function setModifiedGmtAttribute($v){ $this->post_modified_gmt = $v; }
	protected function getContentFilteredAttribute(){ return $this->post_content_filtered; }
	protected function setContentFilteredAttribute($v){ $this->post_content_filtered = $v; }
	protected function getParentAttribute(){ return $this->post_parent; }
	protected function setParentAttribute($v){ $this->post_parent = $v; }
	protected function getTypeAttribute(){ return $this->post_type; }
	protected function setTypeAttribute($v){ $this->post_type = $v; }
	protected function getMimeTypeAttribute(){ return $this->post_mime_type; }
	protected function setMimeTypeAttribute($v){ $this->post_mime_type = $v; }

}


Post::saving(function($record){
	if (! $record->isDirty('post_modified_gmt')) {
		$record->post_modified_gmt =new Carbon(null, 'GMT');
	}
});

Post::creating(function($record){
	if (! $record->isDirty('post_date_gmt')) {
		$record->post_date_gmt = new Carbon(null, 'GMT');
	}
});
