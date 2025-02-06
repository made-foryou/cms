<?php

namespace Made\Cms\Analytics\Enums;

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
