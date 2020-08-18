<?php

namespace Pythagus\LaravelQuickMigration\Commands;

use Illuminate\Console\GeneratorCommand;

/**
 * Class GenerateSeedCommand
 * @package Pythagus\LaravelQuickMigration\Commands
 *
 * @author: Damien MOLINA
 */
class GenerateSeedCommand extends GeneratorCommand {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:seed {name : The name of the class}' ;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new seed file';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Seed';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub () {
        return __DIR__ . '/../stubs/seed.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace) {
        return $rootNamespace.'\Helpers\Seeding';
    }

}
