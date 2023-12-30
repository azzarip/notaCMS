<?php

use Azzarip\NotaCMS\Blog;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

it('loads all the files in the folder', function () {
    $this
        ->artisan('notacms:install')
        ->assertSuccessful();
    
    Artisan::call('notacms:load');

    expect(Blog::count())->toBe(1);
});
