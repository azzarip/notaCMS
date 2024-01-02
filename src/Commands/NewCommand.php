<?php

namespace Azzarip\NotaCMS\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class NewCommand extends Command
{
    public $signature = 'notacms:new {blog?}';

    public $description = 'Create a new blog';

    public function handle(): int
    {
       $blog = $this->argument('blog');
       if (!$blog) {
        $blog = $this->ask('What is the path of your blog?');
       }
       
       $blog = \ucfirst($blog);

       if (File::exists(app_path('Models/' . $blog . '.php'))) {
        $this->error('Model ' . $blog . ' already exists');
        return self::INVALID;
       }
       $content = File::get(__DIR__.'/../../stubs/model.stub');
       $content = str_replace('{{ blog }}', $blog, $content);
       File::put(app_path('Models/' . $blog . '.php'), $content);
       $this->info('Created new model: ' . $blog);

       $blogTable = Str::snake(Str::pluralStudly($blog));
       $content = File::get(__DIR__.'/../../stubs/migration.stub');
       $content = str_replace('{{ blogTable }}', $blogTable, $content);
       File::put(database_path('migrations/' . now()->format('Y_m_d_His') . '_create_' . $blogTable . '_table.php'), $content);
       $this->info('Created new migration.');

       $contentPath = base_path('content/notacms');
       if (!File::exists($contentPath)) {
            File::makeDirectory($contentPath, 0755, true);
        }       
        $contentPath .= '/' . \lcfirst($blog);
        if (!File::exists($contentPath)) {
            File::makeDirectory($contentPath, 0755, true);
            $this->info("Directory '$contentPath' created successfully.");
        }       

        if (!File::exists($contentPath .  '/my-first-post.md')) {
            $content = File::get(__DIR__.'/../../stubs/post.stub');
            File::put($contentPath .  '/my-first-post.md', $content);
        }

        $configPath = config_path('notacms.php');
        $content = File::get($configPath);
        $lines = explode(PHP_EOL, $content);
        do {
            $lastLine = array_pop($lines);
        } while (!str_starts_with(trim($lastLine), '];'));
        $content = implode(PHP_EOL, $lines);
        $content .= PHP_EOL;
        $content .= "    '" . \lcfirst($blog) . "' => \App\Models\\" . $blog . "::class," . PHP_EOL;
        $content .= '];';
        File::put($configPath, $content);
        $this->warn('We registered the new blog in the `notacms.php` config. Check the file for collisions.');
       return self::SUCCESS;
    }
}
