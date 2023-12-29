<?php

use Azzarip\NotaCMS\Tests\Data\BlogFactory;

it('gives full url of the post', function () {
    $post = BlogFactory::new()->create();
    expect($post->url)
        ->toBe(url(config('notacms.blog.path')).'/'.$post->slug);
});
