<?php

namespace Soyhuce\Somake\Commands;

use Illuminate\Console\Command;

class SomakeCommand extends Command
{
    public $signature = 'laravel-somake';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
