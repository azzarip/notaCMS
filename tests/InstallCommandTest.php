<?php

use Illuminate\Support\Facades\File;

it('publishes configuration', function () {
    $this
        ->artisan('notacms:install')
        ->assertSuccessful();

    $this->assertFileExists(config_path('notacms.php'));
});

it('publishes migration', function () {
    $this
        ->artisan('notacms:install')
        ->assertSuccessful();

    $this->assertFileExists(database_path('migrations/2023_12_30_133101_2023_12_23_000000_create_blog_table.php'));
});

it('creates file folder', function () {
    $this
        ->artisan('notacms:install')
        ->assertSuccessful();

    $filePath = base_path('content/notacms/blog/MyFirstPost.html');
    expect(File::exists($filePath))->toBeTrue();
});
