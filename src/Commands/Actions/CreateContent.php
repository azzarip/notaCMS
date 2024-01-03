<?php

namespace Azzarip\NotaCMS\Commands\Actions;

use Illuminate\Support\Facades\File;

class CreateContent
{
    public static function create(string $blog)
    {
        $contentPath = base_path('content/notacms');
        if (! File::exists($contentPath)) {
            File::makeDirectory($contentPath, 0755, true);
        }
        $contentPath .= '/'.\lcfirst($blog);
        if (! File::exists($contentPath)) {
            File::makeDirectory($contentPath, 0755, true);
        }

        if (! File::exists($contentPath.'/my-first-post.md')) {
            $content = File::get(__DIR__.'/../../../stubs/post.stub');
            File::put($contentPath.'/my-first-post.md', $content);
        }
    }
}
