<?php

namespace Made\Cms\Analytics\Commands;

use _PHPStan_d06f792a9\Nette\Neon\Exception;
use Illuminate\Console\Command;
use Made\Cms\Analytics\Models\Settings\AnalyticsSettings;
use Made\Cms\Analytics\Models\Visit;
use Made\Cms\Analytics\Notifications\LogsBackupGeneratedNotification;
use Made\Cms\Models\Role;

class ClearVisitLogsCommand extends Command
{
    protected $signature = 'made:clear-visit-logs';

    protected $description = 'Create a back-up from the past visit logs according to the saving strategy and deletes them.';

    /**
     * Constructor for the class.
     *
     * @param  AnalyticsSettings  $settings  The analytics settings required for configuration.
     */
    public function __construct(
        protected readonly AnalyticsSettings $settings,
    ) {
        parent::__construct();
    }

    /**
     * Handles the deletion of visits based on the defined saving strategy.
     *
     * The method checks the saving strategy configuration to determine
     * if it allows deleting visits. If deletion is allowed, it retrieves
     * the default role and its associated user, sends a notification
     * regarding the backup generation, and deletes visits
     * past the defined threshold date.
     *
     * @throws Exception When the strategy does not delete any visit logs.
     */
    public function handle(): void
    {
        $strategy = $this->settings->getSavingStrategy();

        if (! $strategy->deletesVisits()) {
            $this->info(
                'The saving strategy does not delete visits. You can '
                    . 'change this within Made CMS on the Analytics settings '
                    . 'page.'
            );

            return;
        }

        /** @var Role $role */
        $role = Role::query()->default()->first();
        $user = $role->users->first();

        $user->notify(new LogsBackupGeneratedNotification($strategy));

        Visit::query()
            ->pastThreshold($strategy->getThresholdDate())
            ->delete();
    }
}
