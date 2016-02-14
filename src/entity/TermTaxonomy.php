<?php

namespace atomita\wordpress\eloquent\entity;

use \Illuminate\Database\Eloquent\Model;
use \atomita\wordpress\eloquent\DatabaseManager;

DatabaseManager::bootEloquent();


class TermTaxonomy extends Model {
	/*
	  term_taxonomy_id, term_id, taxonomy, description, parent, count
	 */

	protected $table = 'term_taxonomy';
	protected $primaryKey = 'term_taxonomy_id';
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'taxonomy', 'description', 'parent', 'count'
	];

	public function term(){
		return $this->belongsTo(__NAMESPACE__ . '\Term');
	}

	public function posts(){
		return $this->belongsToMany(__NAMESPACE__ . '\Post',
									'term_relationships',
									'term_taxonomy_id',
									'object_id')
					->withPivot('term_order');
	}
}
