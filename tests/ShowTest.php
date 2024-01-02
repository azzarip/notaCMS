<?php

use Azzarip\NotaCMS\Blog;

use function Pest\Laravel\get;

beforeEach(function () {
    $filePath = base_path('content/notacms/'.array_key_first(config('notacms')).'/MyFirstPost.md');
    expect(File::exists($filePath))->toBeTrue();
    $post = Blog::loadFile($filePath);
    $this->url = $post->url;
});

it('gets post from slug', function () {
    get($this->url)->assertSee('My First Post');
});

it('shows metatitle', function () {
    get($this->url)->assertSee('My First Metatitle');
});

it('shows metadescription', function () {
    get($this->url)->assertSee('This is the meta description of my first Post');
});

it('shows body', function () {
    get($this->url)->assertSee('This is my first Post');
});
