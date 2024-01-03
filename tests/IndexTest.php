<?php

use Azzarip\NotaCMS\Blog;

use function Pest\Laravel\get;
use Azzarip\NotaCMS\Tests\Data\BlogFactory;

test('/{path} is taken from config', function () {
    get(array_key_first(config('notacms')))->assertOk();
});

it('shows title, description, published_at of a post', function () {
    $post = BlogFactory::new()->create();
    get('blog')
        ->assertSee($post->title)
        ->assertSee($post->description);
});

it('paginates from model', function () {
    $postOk = BlogFactory::new()->count(7)->create();
    $postNot = BlogFactory::new()->create([
        'published_at' => now()->subMonth(),
    ]);
    get('blog')
        ->assertSeeText($postOk->pluck('title')->toArray())
        ->assertDontSee($postNot->title);
});

it('shows posts with past published_at', function () {
    $postOk = BlogFactory::new()->create();
    $postNot = BlogFactory::new()->create([
        'published_at' => fake()->dateTimeInInterval('now', '+1 week'),
    ]);

    get('blog')
        ->assertSeeText($postOk->title)
        ->assertDontSeeText($postNot->title);
});
