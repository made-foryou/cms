<?php

namespace Made\Cms\Enums;

enum PageStatus: string
{
    case Draft = 'draft';
    case Published = 'published';

    /**
     * Returns the string label associated with the page status.
     *
     * @return string The localized label for the page status.
     */
    public function label(): string
    {
        return match ($this) {
            self::Draft => __('made-cms::pages.status.draft'),
            self::Published => __('made-cms::pages.status.published'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Draft => 'info',
            self::Published => 'success',
        };
    }

    public static function values(): array
    {
        return collect(self::cases())
            ->map(fn (self $case) => $case->value)
            ->toArray();
    }

    /**
     * Generates an associative array of case values and their corresponding
     * labels.
     *
     * @return array Associative array where keys are case values and values
     *               are their corresponding labels.
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case) => [$case->value => $case->label()])
            ->all();
    }
}
