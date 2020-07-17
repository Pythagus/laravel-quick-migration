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
 * @property Seed seed
 * @property bool update
 *
 * @author: Damien MOLINA
 */
abstract class Seeder extends BaseSeeder {

    /**
     * Seed of the current seeding.
     * If null, the seeder will not
     * have any effects.
     *
     * @var Seed|null
     */
    protected $seed = null ;

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
     * Add all items content in the $items array
     * - Verify if item $i already exists
     *
     * @param array $items
     * @throws Exception
     */
    protected function addItems(array $items) {
        foreach($items as $item) {
            if($this->similarQuery($item)->exists()) {
                if($this->update) {
                    $this->update(
                        $this->similarQuery($item)->first(), $item
                    ) ;
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
        if(is_null($this->seed)) {
            return ;
        }

        $this->addItems(
            $this->seed::all()
        ) ;
    }

    /**
     * Insert the item in the datatable
     *
     * @param array|string $item
     * @throws Exception
     */
    public function insert($item) {
        $model = $this->seed::query()->getModel() ;

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
            $model->fill($data) ;
        }
        /*
         * If It is a string, then we update
         * the primary key value of the model.
         */
        elseif(is_string($data)) {
            $seed = $this->seed ;
            $key  = $seed::$primaryKey ;
            $model->$key = $data ;
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
     * @return Builder
     */
    protected function similarQuery($item) {
        $seed  = $this->seed ;
        $key   = $seed::$primaryKey ;
        $value = is_array($item) ? $item[$key] : $item ;

        return $seed::query()->where($key, $value) ;
    }

}
