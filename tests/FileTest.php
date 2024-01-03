<?php

use Azzarip\NotaCMS\Blog;
use Azzarip\NotaCMS\Commands\Actions\CreateContent;
use Illuminate\Support\Facades\File;

beforeEach(function () {
    $filePath = base_path('content/notacms/blog/my-first-post.md');
    if (! File::exists($filePath)) {
        CreateContent::create('blog');
    }
    $post = Blog::loadFile('my-first-post');
});

it('creates a blog from file', function () {
    $post = Blog::loadFile('my-first-post');
    expect($post->title)->toBe('My First Post');
    expect($post->description)->toBe('This is the description of my first Post');
    expect($post->published_at->format('j F Y'))->toBe('1 January 2023');
});

it('updates a blog if slug exists', function () {
    $original = Blog::create([
        'title' => '::title_original::',
        'description' => '::description_original::',
        'slug' => 'my-first-post',
        'published_at' => '2020-01-01',
    ]);
    Blog::loadFile('my-first-post');
    $post = Blog::findSlug('my-first-post');
    expect($post->title)->toBe('My First Post');
    expect($post->description)->toBe('This is the description of my first Post');
    expect($post->published_at->format('j F Y'))->toBe('1 January 2023');
});

it('returns null if file does not exist', function () {
    $return = Blog::loadFile('not-found');
    expect($return)->toBeNull();
});
