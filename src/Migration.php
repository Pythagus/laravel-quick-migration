<?php

namespace Pythagus\LaravelQuickMigration;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration as BaseMigration;

/**
 * Class Migration
 * @package Pythagus\LaravelQuickMigration
 *
 * @property string table
 *
 * @author: Damien MOLINA
 */
abstract class Migration extends BaseMigration {

    /**
     * Name of the table
     *
     * @var string
     */
    protected $table;

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists($this->table) ;
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if(! Schema::hasTable($this->table)) {
            Schema::create($this->table, function(Blueprint $table) {
                $this->structure($table);
            }) ;
        }
    }

    /**
     * Structure of the table.
     *
     * @param Blueprint $table
     * @return void
     */
    abstract public function structure(Blueprint $table);

}
