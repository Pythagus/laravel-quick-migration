<?php

namespace Pythagus\LaravelQuickMigration;

use Illuminate\Support\ServiceProvider;
use Pythagus\LaravelQuickMigration\Commands\GenerateSeedCommand;

/**
 * Class QuickMigrationServiceProvider
 * @package Pythagus\LaravelQuickMigration
 *
 * @property array commands
 *
 * @author: Damien MOLINA
 */
class QuickMigrationServiceProvider extends ServiceProvider {

    /**
     * @var array
     */
    protected $commands = [
        GenerateSeedCommand::class,
    ] ;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->commands($this->commands) ;

        $this->publishes(
	        $this->getStubs(['migration.create', 'seeder']), 'quick-migration-stubs'
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
