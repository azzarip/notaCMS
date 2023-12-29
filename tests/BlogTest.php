<?php

use Azzarip\NotaCMS\Database\Factories\BlogFactory;

use function Pest\Laravel\get;

test('/{path} is taken from config', function () {
    get(config('blog.path'))->assertOk();
});

it('shows title, description, published_at of a post', function () {
    $post = BlogFactory::new()->create();
    get(config('blog.path'))
        ->assertSee($post->title)
        ->assertSee($post->description);
});

it('paginates from config', function () {
    $paginate = config('blog.paginate');
    $postOk = BlogFactory::new()->count($paginate)->create();
    $postNot = BlogFactory::new()->create();

    get(config('blog.path'))
        ->assertSeeTextInOrder($postOk->pluck('title')->toArray())
        ->assertDontSee($postNot->title);
});

it('shows posts with past published_at', function () {
    $postOk = BlogFactory::new()->create();
    $postNot = BlogFactory::new()->create([
        'published_at' => fake()->dateTimeInInterval('now', '+1 week'),
    ]);

    get(config('blog.path'))
        ->assertSeeText($postOk->title)
        ->assertDontSeeText($postNot->title);
});
