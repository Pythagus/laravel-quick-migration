# Laravel Quick Migration
Package to simplify the migrations and solve the *"Table already exists"* issue.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

## Installation
You can quickly add this package in your application using Composer. **Be careful** to use the correct version of the package regarding your Laravel application version:

### Version
| Laravel | Package        |
|----------|:-------------:|
| 5.3 to 7.x | 1.x |
| 8.x | 2.x |

### Composer
In a Bash terminal:
```bash
composer require pythagus/laravel-quick-migration
```

## Usage
In this section, we will see how to use the current package features.

### Make a migration
You still can use the ```php artisan make:migration CreateTableNameTable``` command to generate the migration. You will able to change the extended class to ```Pythagus\LaravelQuickMigration\Migration```.

##### Since Laravel 7.0
Since Laravel 7.0, you can customize the stubs. To use by default the current migration tool, you can execute:
```bash
php artisan vendor:publish --tag=quick-migration-stubs
```

## Architecture
This is the files' architecture of the package:
```
.
├── composer.json
├── LICENSE
├── README.md
└── src
    ├── Migration.php
    ├── QuickMigrationServiceProvider.php
    ├── Seeds
    │   ├── Seeder.php
    │   └── Seed.php
    └── stubs
        ├── migration.create.stub
        └── seeder.stub

3 directories, 9 files
```

You can generate the previous tree using:
```bash
sudo apt install tree
tree -I '.git|vendor'
```

## Licence
This package is under the terms of the [MIT license](https://opensource.org/licenses/MIT).
