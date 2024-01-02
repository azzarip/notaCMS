<?php

use Azzarip\NotaCMS\Blog;
use Illuminate\Support\Facades\Artisan;

it('asks for blog name if not given', function () {
    Artisan::call('notacms:new');
    expect(Artisan::output())->toBe('What is the path of your blog?');
});
