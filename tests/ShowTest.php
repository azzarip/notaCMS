<?php

use function Pest\Laravel\get;
use Azzarip\NotaCMS\Tests\Data\BlogFactory;

it('gets post from slug', function () {
    $post = BlogFactory::new()->create();
    get($post->url)->assertSee($post->title);
});
