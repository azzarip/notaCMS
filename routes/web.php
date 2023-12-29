<?php

use Azzarip\NotaCMS\Blog;
use Illuminate\Support\Facades\Route;

Route::get('/blog', function () {
    $posts = Blog::published();
    return view('notacms::index', compact('posts'));
});