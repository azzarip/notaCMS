<?php

namespace Azzarip\NotaCMS;

use Azzarip\NotaCMS\Commands\LoadCommand;
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
            ->hasMigration('create_seo_table')
            ->hasRoute('web')
            ->hasCommand(LoadCommand::class)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->copyAndRegisterServiceProviderInApp();

                $path = base_path('/content/notacms/blog');
                File::makeDirectory($path, 0755, true, true);
                $content = file_get_contents(__DIR__.'/../assets/MyFirstPost.html');
                File::put($path.'/MyFirstPost.html', $content);
            });
    }
}
