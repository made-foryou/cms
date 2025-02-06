<?php

namespace Made\Cms\Analytics\Enums;

use _PHPStan_d06f792a9\Nette\Neon\Exception;
use Illuminate\Support\Carbon;

enum VisitSavingStrategy: string
{
    case SaveAll = 'save_all';
    case SaveHalfYear = 'save_half_year';
    case SaveYear = 'save_year';
    case Save2Years = 'save_2_years';
    case Save3Years = 'save_3_years';

    /**
     * Retrieves the label associated with the current enum case.
     *
     * @return string The localized label string for the enum case.
     */
    public function label(): string
    {
        return match ($this) {
            self::SaveAll => __('made-cms::cms.enums.visit_saving.save_all.label'),
            self::SaveHalfYear => __('made-cms::cms.enums.visit_saving.save_half_year.label'),
            self::SaveYear => __('made-cms::cms.enums.visit_saving.save_year.label'),
            self::Save2Years => __('made-cms::cms.enums.visit_saving.save_2_years.label'),
            self::Save3Years => __('made-cms::cms.enums.visit_saving.save_3_years.label'),
        };
    }

    /**
     * Retrieves the threshold date based on the current strategy.
     *
     * @return Carbon Returns the calculated threshold date for the specified strategy.
     *                If the strategy does not provide a threshold, an exception is thrown.
     *
     * @throws Exception Throws an exception when the strategy does not delete anything.
     */
    public function getThresholdDate(): Carbon
    {
        return match ($this) {
            self::SaveHalfYear => now()->subMonths(6)->startOfDay(),
            self::SaveYear => now()->subYear()->startOfDay(),
            self::Save2Years => now()->subYears(2)->startOfDay(),
            self::Save3Years => now()->subYears(3)->startOfDay(),
            default => throw new Exception('This strategy does not have a threshold date.'),
        };
    }

    /**
     * Determines whether visit records should be deleted based on the current context.
     *
     * @return bool Returns true if visits should be deleted; otherwise, false.
     */
    public function deletesVisits(): bool
    {
        return match ($this) {
            self::SaveAll => false,
            default => true,
        };
    }

    /**
     * Retrieves an associative array of options based on the cases of the enum.
     *
     * @return array An associative array where the keys are the enum values and the values are their corresponding labels.
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $strategy) => [$strategy->value => $strategy->label()])
            ->toArray();
    }
}
