<?php

namespace Azzarip\NotaCMS\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LoadCommand extends Command
{
    public $signature = 'notacms:load';

    public $description = 'Loads all the files';

    public function handle(): int
    {
        $files = File::files(base_path('content/notacms/blog'));
        $htmlFiles = array_filter($files, function ($file) {
            return pathinfo($file, PATHINFO_EXTENSION) === 'html';
        });

        $this->comment(count($htmlFiles).' Files found');

        foreach ($htmlFiles as $file) {
            \Azzarip\NotaCMS\Blog::loadFile($file->getPathname());
        }
        $this->comment('All files loaded');

        return self::SUCCESS;
    }
}
