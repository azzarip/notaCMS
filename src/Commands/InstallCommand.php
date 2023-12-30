<?php

namespace Azzarip\NotaCMS\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    public $signature = 'nota:install';

    public $description = 'Install the required files and directories';

    public function handle(): int
    {
        $this->comment('Publish configuration');

        return self::SUCCESS;
    }
}
