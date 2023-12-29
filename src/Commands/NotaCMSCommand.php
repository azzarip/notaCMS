<?php

namespace Azzarip\NotaCMS\Commands;

use Illuminate\Console\Command;

class NotaCMSCommand extends Command
{
    public $signature = 'notacms';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
