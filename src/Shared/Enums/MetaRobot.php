<?php

namespace Made\Cms\Shared\Enums;

enum MetaRobot: string
{
    case IndexAndFollow = 'index, follow';
    case NoIndexAndNoFollow = 'noindex, nofollow';
    case NoIndexAndFollow = 'noindex, follow';
    case IndexAndNoFollow = 'index, nofollow';

    /**
     * Returns the label for the current MetaRobot case.
     *
     * @return string The label corresponding to the MetaRobot case.
     */
    public function label(): string
    {
        return match ($this) {
            self::IndexAndFollow => 'Index and follow',
            self::NoIndexAndNoFollow => 'No index and no follow',
            self::NoIndexAndFollow => 'No index and follow',
            self::IndexAndNoFollow => 'Index and no follow',
        };
    }

    /**
     * Generates an associative array of MetaRobot case values mapped to their labels.
     *
     * @return array The associative array of MetaRobot case values and labels.
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (MetaRobot $case): array => [
                $case->value => $case->label(),
            ])
            ->toArray();
    }
}
