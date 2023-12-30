<?php

use Carbon\Carbon;
use Azzarip\NotaCMS\Blog;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use function Spatie\PestPluginTestTime\testTime;

it('creates file folder', function () {
    $this
        ->artisan('notacms:install')
        ->assertSuccessful();

    $filePath = base_path('content/notacms/' . array_key_first(config('notacms')) . '/MyFirstPost.html');
    expect(File::exists($filePath))->toBeTrue();
});