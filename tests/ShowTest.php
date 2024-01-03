<?php

use Azzarip\NotaCMS\Blog;
use function Pest\Laravel\get;
use Illuminate\Support\Facades\File;
use Azzarip\NotaCMS\Commands\Actions\CreateContent;

beforeEach(function () {
    $filePath = base_path('content/notacms/blog/my-first-post.md');
    if(!File::exists($filePath)) {
        CreateContent::create('blog');
    }
    $post = Blog::loadFile('my-first-post');
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
    get($this->url)->assertSee('This is my first post');
});

afterEach(function () {
    File::cleanDirectory(app_path('Models'));
    File::cleanDirectory(database_path('Migrations'));
    File::cleanDirectory(app_path('content'));
    File::cleanDirectory(resource_path('views/vendor/notacms/testblog'));
});