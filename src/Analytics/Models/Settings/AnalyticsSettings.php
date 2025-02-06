<?php

namespace Made\Cms\Analytics\Models\Settings;

use Made\Cms\Analytics\Enums\VisitSavingStrategy;
use Spatie\LaravelSettings\Settings;

class AnalyticsSettings extends Settings
{
    public array $ip_blacklist = [];

    public ?string $saving_strategy = VisitSavingStrategy::SaveAll->value;

    /**
     * Retrieves the group name.
     *
     * @return string The name of the group.
     */
    public static function group(): string
    {
        return 'analytics';
    }
}
