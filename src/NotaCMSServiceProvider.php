<?php

namespace azzarip\NotaCMS;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use azzarip\NotaCMS\Commands\NotaCMSCommand;

class NotaCMSServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('notacms')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_notacms_table')
            ->hasCommand(NotaCMSCommand::class);
    }
}
