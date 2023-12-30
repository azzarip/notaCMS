<?php

use Azzarip\NotaCMS\Blog;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

it('loads all the files in the folder', function () {
    Storage::fake();
    Storage::put('blogpost.html', file_get_contents(__DIR__.'/Data/blogpost.html'));

    Artisan::call('nota:load');

    expect(Blog::count())->toBe(1);
});