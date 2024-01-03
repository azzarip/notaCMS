<?php

namespace Azzarip\NotaCMS;

use Azzarip\NotaCMS\Commands\LoadCommand;
use Azzarip\NotaCMS\Commands\NewCommand;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
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
            ->hasConfigFile('notacms')
            ->hasViews()
            ->hasMigration('create_blog_table')
            ->hasRoute('web')
            ->hasCommand(LoadCommand::class)
            ->hasCommand(NewCommand::class)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->copyAndRegisterServiceProviderInApp();
            });
    }
}
