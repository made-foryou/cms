<?php

namespace Made\Cms\Shared\Enums;

enum PublishingStatus: string
{
    /**
     * Default status Draft
     *
     * This status defines items which are still in draft.
     */
    case Draft = 'draft';

    /**
     * Published
     *
     * These items will be stated as published and will be visible to the
     * visitors according to the visibility settings of the current
     * item.
     */
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

    /**
     * Determines the color code associated with the current state.
     *
     * @return string The color code corresponding to the state, such as 'info' for draft or 'success' for published.
     */
    public function color(): string
    {
        return match ($this) {
            self::Draft => 'info',
            self::Published => 'success',
        };
    }

    /**
     * Retrieves an array of values for all cases of the enum.
     *
     * @return array The array containing the values of the enum cases.
     */
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
