<?php

namespace Azzarip\NotaCMS;

use Azzarip\NotaCMS\Commands\LoadCommand;
use Azzarip\NotaCMS\Commands\NewCommand;
use Illuminate\Support\Facades\File;
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
                    ->publishMigrations()
                    ->publish('views')
                    ->copyAndRegisterServiceProviderInApp();

                $path = base_path('/content/notacms/blog');
                File::makeDirectory($path, 0755, true, true);
                $content = file_get_contents(__DIR__.'/../assets/MyFirstPost.md');
                File::put($path.'/MyFirstPost.md', $content);
            });
    }
}
