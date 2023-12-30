<?php

namespace Azzarip\NotaCMS\Tests;

use Azzarip\NotaCMS\NotaCMSServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Azzarip\\NotaCMS\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function tearDown(): void
    {
        File::deleteDirectory(base_path('content'));
        parent::tearDown();
    }

    protected function getPackageProviders($app)
    {
        return [
            NotaCMSServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $migration = include __DIR__.'/../database/migrations/create_blog_table.php';
        $migration->up();

    }
}
