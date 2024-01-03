<?php

namespace Azzarip\NotaCMS\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class LoadCommand extends Command
{
    public $signature = 'notacms:load {blog?}';

    public $description = 'Loads all the files';

    public function handle(): int
    {
        $blog = $this->argument('blog');
        $blogs = array_keys(config('notacms'));

        if (! $blog) {
            $blogs = array_keys(config('notacms'));
            $blog = $this->choice('Which blog you want to load to database?',
                Arr::prepend($blogs, 'all'),
                $default = 'all');
        }

        if ($blog === 'all') {
            foreach ($blogs as $blog) {
                $this->loadBlog($blog);
                $this->comment('All files loaded for: '.$blog);
            }

            return self::SUCCESS;
        }

        $this->loadBlog($blog);

        return self::SUCCESS;
    }

    private function loadBlog(string $blog): void
    {
        $files = File::files(base_path('content/notacms/'.$blog));
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'md') {
                $slug = pathinfo($file, PATHINFO_FILENAME);
                $model = config('notacms.'.$blog);
                call_user_func([$model, 'loadFile'], $slug);
            }
        }
    }
}
