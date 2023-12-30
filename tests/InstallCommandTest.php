<?php

use Illuminate\Support\Facades\File;

it('creates file folder', function () {
    $this
        ->artisan('notacms:install')
        ->assertSuccessful();

    $filePath = base_path('content/notacms/'.array_key_first(config('notacms')).'/MyFirstPost.html');
    expect(File::exists($filePath))->toBeTrue();
});
