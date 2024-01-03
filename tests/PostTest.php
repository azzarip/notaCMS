<?php

use Azzarip\NotaCMS\Tests\Data\BlogFactory;

it('gives full url of the post', function () {
    $post = BlogFactory::new()->create();
    expect($post->url)
        ->toBe(url($post->getRoute()).'/'.$post->slug);
});

it('returns the path name as lower case', function () {
    $post = BlogFactory::new()->create();
    expect($post->getRoute())
        ->toBe('blog');
});
