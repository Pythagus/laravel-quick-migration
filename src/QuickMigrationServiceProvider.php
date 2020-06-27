<?php

namespace Pythagus\LaravelQuickMigration;

use Illuminate\Support\ServiceProvider;

/**
 * Class QuickMigrationServiceProvider
 * @package Pythagus\LaravelQuickMigration
 *
 * @author: Damien MOLINA
 */
class QuickMigrationServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->publishes(
	        $this->getStubs(['migration.create']), 'quick-migration-stubs'
        ) ;
    }

    /**
     * @param array $names
     * @return array
     */
    private function getStubs(array $names) {
        $files = [] ;

        foreach($names as $name) {
            $files[__DIR__.'/stubs/'.$name.'.stub'] = base_path('stubs/'.$name.'.stub') ;
        }

        return $files ;
    }

}
