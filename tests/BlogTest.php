<?php 
use function Pest\Laravel\get;
use Azzarip\NotaCMS\Database\Factories\BlogFactory;


test('/{blog} shows title and description of a post', function () {
    $post = BlogFactory::new()->create();
    get(config('blog.path'))
        ->assertSee($post->title)
        ->assertSee($post->description);
});

test('/{blog} paginates from config', function () {
    $paginate = config('blog.paginate');
    $postOk = BlogFactory::new()->count($paginate)->create();
    $postNot = BlogFactory::new()->create();

    get(config('blog.path'))
         ->assertSeeTextInOrder($postOk->pluck('title')->toArray())
         ->assertDontSee($postNot->title);
});
