<?php

namespace Azzarip\NotaCMS;

use Azzarip\NotaCMS\Commands\NotaCMSCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasConfigFile('blog')
            ->hasViews()
            ->hasMigration('create_notacms_table')
            ->hasRoute('web')
            ->hasCommand(NotaCMSCommand::class);
    }
}
