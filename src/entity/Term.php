<?php

namespace atomita\wordpress\eloquent\entity;

use \Illuminate\Database\Eloquent\Model;
use \atomita\wordpress\eloquent\DatabaseManager;

DatabaseManager::bootEloquent();


class Term extends Model {
	/*
	  term_id, name, slug, term_group
	*/

	protected $table = 'terms';
	protected $primaryKey = 'term_id';
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'slug', 'term_group'
	];

	public function termTaxonomy(){
		return $this->hasOne(__NAMESPACE__ . '\TermTaxonomy');
	}
}
