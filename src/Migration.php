<?php

namespace Pythagus\LaravelQuickMigration;

use Exception;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration as BaseMigration;

/**
 * Class Migration
 * @package Pythagus\LaravelQuickMigration
 *
 * @property string table
 * @property Model  class
 *
 * @author: Damien MOLINA
 */
abstract class Migration extends BaseMigration {

	/**
	 * Name of the table
	 *
	 * @var string
	 */
	protected $table ;

	/**
	 * Class name of the migration.
	 *
	 * @var Model
	 */
	protected $class ;

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 * @throws Exception
	 */
	public function down() {
		Schema::dropIfExists($this->getTable()) ;
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 * @throws Exception
	 */
	public function up() {
		$table = $this->getTable() ;

		if(! Schema::hasTable($table)) {
			Schema::create($table, function(Blueprint $t) {
				$this->structure($t);
			}) ;
		}
	}

	/**
	 * Get the table name.
	 *
	 * @return string
	 * @throws Exception
	 */
	protected function getTable() {
		if(! empty($class = $this->class)) {
			return app($class)->getTable() ;
		}

		if(! empty($table = $this->table)) {
			return $table ;
		}

		throw new Exception("Undefined class in ".static::class." migration.") ;
	}

	/**
	 * Structure of the table.
	 *
	 * @param Blueprint $table
	 * @return void
	 */
	abstract public function structure(Blueprint $table);

}
