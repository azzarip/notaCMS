<?php

use Azzarip\NotaCMS\Database\Factories\BlogFactory;

it('gives full url of the post', function () {
    $post = BlogFactory::new()->create();
    expect($post->url)
    ->toBe(url(config('blog.path')) . '/' . $post->slug);
});