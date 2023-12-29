<?php

use Azzarip\NotaCMS\Tests\Data\BlogFactory;

use function Pest\Laravel\get;

it('gets post from slug', function () {
    $post = BlogFactory::new()->create();
    get($post->url)->assertSee($post->title);
});
