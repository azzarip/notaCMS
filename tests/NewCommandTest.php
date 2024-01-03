<?php

use Azzarip\NotaCMS\Blog;
use Illuminate\Support\Facades\Artisan;

it('asks for blog name if not given', function () {
    $this->artisan('notacms:new')
        ->expectsQuestion('What is the path of your blog?', 'testblog')
        ->assertExitCode(0);

});

it('creates a model', function () {
    expect(File::exists(app_path('Models/Testblog.php')))
        ->toBeFalse();

    $this->artisan('notacms:new testblog')
        ->assertExitCode(0);

    expect(File::exists(app_path('Models/Testblog.php')))
        ->toBeTrue();
});

it('creates a migration', function () {
    expect(File::files(database_path('Migrations')))
        ->toBeEmpty();
    
    $this->artisan('notacms:new testblog')
        ->assertExitCode(0);

    expect(File::files(database_path('Migrations')))
        ->toHaveCount(1);

});

it('creates first post', function () {
    expect(File::files(base_path('content')))
        ->toBeEmpty();
    
    $this->artisan('notacms:new testblog')
        ->assertExitCode(0);

    expect(File::exists(base_path('content/notacms/testblog/my-first-post.md')))
        ->toBeTrue();

});

it('creates the views', function () {
    expect(File::files(resource_path('views/vendor/notacms/testblog')))
        ->toBeEmpty();
    
    $this->artisan('notacms:new testblog')
        ->assertExitCode(0);

    expect(File::exists(resource_path('views/vendor/notacms/testblog/show.blade.php')))
        ->toBeTrue();
    expect(File::exists(resource_path('views/vendor/notacms/testblog/index.blade.php')))
        ->toBeTrue();

});

it('adds the model to config', function () {
    expect(\Illuminate\Support\Facades\Config::get('notacms.testblog'))
        ->not->toBeEmpty();
});



afterEach(function () {
    File::cleanDirectory(app_path('Models'));
    File::cleanDirectory(database_path('Migrations'));
    File::cleanDirectory(app_path('content'));
    File::cleanDirectory(resource_path('views/vendor/notacms/testblog'));
});