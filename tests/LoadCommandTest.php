<?php

use Azzarip\NotaCMS\Blog;
use Azzarip\NotaCMS\Commands\Actions\CreateContent;
use Illuminate\Support\Facades\File;

beforeEach(function () {
    $filePath = base_path('content/notacms/blog/my-first-post.md');
    if (! File::exists($filePath)) {
        CreateContent::create('blog');
    }
});

it('asks for blog name if not given', function () {
    $this->artisan('notacms:load')
        ->expectsQuestion('Which blog you want to load to database?', 'blog')
        ->assertSuccessful();

});

it('loads all the files for blog', function () {
    $this
        ->artisan('notacms:load blog')
        ->assertSuccessful();

    expect(Blog::count())->toBe(1);
});
