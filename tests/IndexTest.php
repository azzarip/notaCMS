<?php

use Azzarip\NotaCMS\Tests\Data\BlogFactory;

use function Pest\Laravel\get;

test('/{path} is taken from config', function () {
    get(config('notacms.blog.path'))->assertOk();
});

it('shows title, description, published_at of a post', function () {
    $post = BlogFactory::new()->create();
    get(config('notacms.blog.path'))
        ->assertSee($post->title)
        ->assertSee($post->description);
});

it('paginates from config', function () {
    $postOk = BlogFactory::new()->count(7)->create();
    $postNot = BlogFactory::new()->create([
        'published_at' => now()->subMonth(),
    ]);
    get(config('notacms.blog.path'))
        ->assertSeeText($postOk->pluck('title')->toArray())
        ->assertDontSee($postNot->title);
});

it('shows posts with past published_at', function () {
    $postOk = BlogFactory::new()->create();
    $postNot = BlogFactory::new()->create([
        'published_at' => fake()->dateTimeInInterval('now', '+1 week'),
    ]);

    get(config('notacms.blog.path'))
        ->assertSeeText($postOk->title)
        ->assertDontSeeText($postNot->title);
});
