<?php

use Azzarip\NotaCMS\Blog;

beforeEach(function () {
    $this->path = __DIR__.'/../tests/Data/blogpost.md';
});

it('creates a blog from file', function () {
    $post = Blog::loadFile($this->path);
    expect($post->title)->toBe('::title::');
    expect($post->description)->toBe('::description::');
    expect($post->published_at->format('j F Y'))->toBe('5 October 2000');
});

it('updates a blog if slug exists', function () {
    $original = Blog::create([
        'title' => '::title_original::',
        'description' => '::description_original::',
        'slug' => 'blogpost',
        'published_at' => '2020-01-01',
    ]);
    Blog::loadFile($this->path);
    $post = Blog::findSlug('blogpost');
    expect($post->title)->toBe('::title::');
    expect($post->description)->toBe('::description::');
    expect($post->published_at->format('j F Y'))->toBe('5 October 2000');
});

it('returns null if file does not exist', function () {
    $return = Blog::loadFile(str_replace($this->path, 'notfound', 'blogpost'));
    expect($return)->toBeNull();
});
