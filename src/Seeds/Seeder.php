<?php

namespace Pythagus\LaravelQuickMigration\Seeds;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder as BaseSeeder;

/**
 * Class Seeder
 * @package Pythagus\LaravelQuickMigration\Seeds
 *
 * @property string primaryKey
 * @property bool   update
 *
 * @author: Damien MOLINA
 */
abstract class Seeder extends BaseSeeder {

	/**
	 * The primary key of the model. This value
	 * determines which column will be responsible
	 * of the unity of the value.
	 *
	 * @var string
	 */
	public $primaryKey = null ;

	/**
	 * If an item already exists in the
	 * datatable, this property allows
	 * you to update or not the found
	 * object.
	 *
	 * @var bool
	 */
	protected $update = false ;

	/**
	 * This method should return the
	 * list of the whole data.
	 *
	 * @return array
	 */
	abstract public function all() ;

	/**
	 * This method should return a query
	 * builder instance.
	 *
	 * @return Builder
	 */
	abstract public function query() ;

	/**
	 * Add all items content in the $items array
	 * - Verify if item $i already exists
	 *
	 * @param array $items
	 * @throws Exception
	 */
	protected function addItems(array $items) {
		foreach($items as $item) {
			if(! empty($similar = $this->similar($item))) {
				if($this->update) {
					$this->update($similar, $item) ;
				}
			} else {
				$this->insert($item) ;
			}
		}
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 * @throws Exception
	 */
	public function run() {
		$this->addItems($this->all()) ;
	}

	/**
	 * Insert the item in the datatable
	 *
	 * @param array|string $item
	 * @throws Exception
	 */
	public function insert($item) {
		$model = $this->query()->getModel() ;

		$this->update(new $model, $item) ;
	}

	/**
	 * Update the item instance.
	 *
	 * @param Model $model
	 * @param array|string $data
	 */
	public function update(Model $model, $data) {
		/*
		 * If the given data is an array,
		 * then we just call the fill method.
		 */
		if(is_array($data)) {
			$model->forceFill($data) ;
		}
		/*
		 * If It is a string, then we update
		 * the primary key value of the model.
		 */
		elseif(is_string($data)) {
			$model->setAttribute($this->primaryKey, $data) ;
		}

		/*
		 * In all case, we save the
		 * model from the modifications.
		 */
		$model->save() ;
	}

	/**
	 * Get a formatted query to find
	 * the similar models.
	 *
	 * @param array|string $item
	 * @return Model
	 */
	protected function similar($item) {
		if(empty($this->primaryKey)) {
			return null ;
		}

		$value = is_array($item) ? $item[$this->primaryKey] : $item ;

		return $this->query()->where(
			$this->primaryKey, $value
		)->first() ;
	}

}
