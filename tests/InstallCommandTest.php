<?php

use Carbon\Carbon;
use Azzarip\NotaCMS\Blog;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

it('publishes configuration', function () {
    $this
        ->artisan('notacms:install')
        ->assertSuccessful();

    $this->assertFileExists(config_path('notacms.php'));
});

it('publishes migration', function () {
    Carbon::setTestNow(Carbon::parse('2020-01-01 00:00:00'));

    $this
        ->artisan('notacms:install')
        ->assertSuccessful();
    
    $this->assertFileExists(database_path('migrations/2023_12_30_133101_2023_12_23_000000_create_blog_table.php'));
});