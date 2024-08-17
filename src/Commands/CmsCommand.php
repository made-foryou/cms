<?php

namespace Made\Cms\Commands;

use Illuminate\Console\Command;

class CmsCommand extends Command
{
    public $signature = 'cms';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
