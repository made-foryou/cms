<?php

namespace Made\Cms\Analytics\Commands;

use _PHPStan_d06f792a9\Nette\Neon\Exception;
use Illuminate\Console\Command;
use Made\Cms\Analytics\Models\Settings\AnalyticsSettings;
use Made\Cms\Analytics\Models\Visit;

class ClearVisitLogsCommand extends Command
{
    protected $signature = 'made:clear-visit-logs';

    protected $description = 'Create a back-up from the past visit logs according to the saving strategy and deletes them.';

    public function __construct(
        protected readonly AnalyticsSettings $settings,
    ) {
        parent::__construct();
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $strategy = $this->settings->getSavingStrategy();

        if (! $strategy->deletesVisits()) {
            $this->info('The saving strategy does not delete visits.');

            return;
        }

        $logs = Visit::query()
            ->pastThreshold($strategy->getThresholdDate())
            ->get();
    }
}
