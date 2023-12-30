<?php

namespace Azzarip\NotaCMS\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class LoadCommand extends Command
{
    public $signature = 'nota:load';

    public $description = 'Loads all the files';

    public function handle(): int
    {
        $files = Storage::files();
        $htmlFiles = array_filter($files, function ($file) {
            return pathinfo($file, PATHINFO_EXTENSION) === 'html';
        });

        $this->comment(count($htmlFiles).' Files found');

        foreach ($htmlFiles as $file) {
            \Azzarip\NotaCMS\Blog::loadFile(Storage::path($file));
        }

        $this->comment('All files loaded');

        return self::SUCCESS;
    }
}
