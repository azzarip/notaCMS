<?php

use Illuminate\Support\Facades\Route;

Route::get('/{blog}', function (string $blog) {
    $model = config('notacms.'.$blog);
    $posts = call_user_func([$model, 'published']);
    return view('notacms::'.$blog.'.index', compact('posts'));
})->whereIn('blog', array_keys(config('notacms')));

Route::get('/{blog}/{slug}', function (string $blog, string $slug) {
    $model = config('notacms.'.$blog);
    $post = call_user_func([$model, 'findSlug'], $slug);

    return view('notacms::'.$blog.'.show', compact('post'));
})->whereIn('blog', array_keys(config('notacms')));
