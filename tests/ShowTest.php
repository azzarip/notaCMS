<?php

use Azzarip\NotaCMS\Database\Factories\BlogFactory;
use function Pest\Laravel\get;

it('gets post from slug', function () {
    $post = BlogFactory::new()->create();
    get($post->url)->assertSee($post->title);
});
