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
    
        $this->comment(count($htmlFiles).' Files found');

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'html') {
                \Azzarip\NotaCMS\Blog::loadFile($file->getPathname());
            }
        }
        $this->comment('All files loaded');

        return self::SUCCESS;
    }
}
