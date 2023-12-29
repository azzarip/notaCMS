<?php

use Azzarip\NotaCMS\Blog;
use Illuminate\Support\Facades\Route;

Route::get(config('notacms.blog.path'), function () {
    $posts = Blog::published();

    return view('notacms::index', compact('posts'));
});

Route::get(config('notacms.blog.path') . '/{slug}', function ($slug) {
    $post = Blog::open($slug);
    return view('notacms::show', compact('post'));
});
