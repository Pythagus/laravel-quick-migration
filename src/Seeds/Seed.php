<?php

namespace Pythagus\LaravelQuickMigration\Seeds;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class Seed
 * @package Pythagus\LaravelQuickMigration\Seeds
 *
 * @property string primaryKey
 *
 * @author: Damien MOLINA
 */
abstract class Seed {

    /**
     * The primary key of the model. This value
     * determines which column will be responsible
     * of the unity of the value.
     *
     * @var string
     */
    public static $primaryKey = 'id' ;

    /**
     * This method should return the whole data
     * that will be inserted in the database.
     *
     * @return array
     */
    abstract public static function all() ;

    /**
     * This method should return a new query
     * instance from the model.
     *
     * @example User::query()
     *
     * @return Builder
     */
    abstract public static function query() ;

}
