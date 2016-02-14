<?php

namespace atomita\wordpress\eloquent\entity\traits;

trait Metable {
	/**
	 * returnd all cloumn name on the entity
	 * @return array
	 */
	abstract public function getColumnNames();

	/**
	 * returnd a relationship for the meta table
	 * @return Illuminate\Database\Eloquent\Relations\HasMany
	 */
	abstract public function metas();


	/**
	 * Set a given attribute on the model.
	 *
	 * @param  string  $key
	 * @param  mixed  $value
	 * @return $this
	 */
	public function setAttribute($key, $value){
		if (in_array($key, $this->getColumnNames()) || $this->hasSetMutator($key)) {
			return parent::setAttribute($key, $value);
		}

		// meta
		$meta = $this->metas()->firstOrNew(['meta_key'=> $key]);
		$meta->value = $value;
		$meta->save();
		return $this;
	}

	/**
	 * Get an attribute from the model.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public function getAttribute($key){
		if (in_array($key, $this->getColumnNames()) || $this->hasGetMutator($key) ||
			method_exists($this, $key)) {

			return parent::getAttribute($key);
		}

		// meta
		$meta = $this->metas()->firstOrNew(['meta_key'=> $key]);
		return $meta->value;
	}
}
