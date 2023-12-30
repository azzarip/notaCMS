<?php

namespace Azzarip\NotaCMS;

use Illuminate\Support\Facades\File;
use Spatie\LaravelPackageTools\Package;
use Azzarip\NotaCMS\Commands\LoadCommand;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Commands\InstallCommand;

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
            ->hasMigration('2023_12_23_000000_create_blog_table')
            ->hasRoute('web')
            ->hasCommand(LoadCommand::class)
            ->hasInstallCommand(function(InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->copyAndRegisterServiceProviderInApp();
                
                $path = base_path('/content/notacms/blog');
                File::makeDirectory($path, 0755, true, true);
                $content = file_get_contents(__DIR__.'/../assets/MyFirstPost.html');
                File::put($path . '/MyFirstPost.html', $content);
            });
    }
}
