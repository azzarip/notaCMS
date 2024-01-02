<?php

use Azzarip\NotaCMS\Blog;

use function Pest\Laravel\get;
use Azzarip\NotaCMS\Tests\Data\BlogFactory;

beforeEach(function() {
    $path = __DIR__.'/../tests/Data/blogpost.html';
    $this->post = Blog::loadFile($path);
    $this->url = $this->post->url;
});

it('gets post from slug', function () {
    get($this->url)->assertSee('::title::');
});

it('shows metatitle', function () {
    get($this->url)->assertSee('::metatitle::');
});

it('shows metadescription', function () {
    get($this->url)->assertSee('::metadescription::');
});