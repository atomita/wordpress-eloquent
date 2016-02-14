<?php

namespace atomita\wordpress\eloquent\entity;

use \Illuminate\Database\Eloquent\Model;
use \atomita\wordpress\eloquent\DatabaseManager;

DatabaseManager::bootEloquent();


class Link extends Model {
	/*
	  link_id, link_url, link_name, link_image, link_target, link_description,
	  link_visible, link_owner, link_rating, link_updated, link_rel, link_notes,
	  link_rss
	*/

	protected $table = 'links';
	protected $primaryKey = 'link_id';
	public $timestamps = false;
	/**
	 * The name of the "updated at" column.
	 *
	 * @var string
	 */
	const UPDATED_AT = 'link_updated';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [];
}


Link::saving(function($record){
	if (! $record->isDirty(Link::UPDATED_AT)) {
		$record->setUpdatedAt($record->freshTimestamp());
	}
});
