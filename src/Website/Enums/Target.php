<?php

declare(strict_types=1);

namespace Made\Cms\Website\Enums;

enum Target: string
{
    case Self = '_self';
    case Blank = '_blank';

    public function getLabel(): string
    {
        return match ($this) {
            self::Self => __('made-cms::cms.enums.target._self.label'),
            self::Blank => __('made-cms::cms.enums.target._blank.label'),
        };
    }

    public function getDescription(): string
    {
        return match ($this) {
            self::Self => __('made-cms::cms.enums.target._self.description'),
            self::Blank => __('made-cms::cms.enums.target._blank.description'),
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Self => 'heroicon-o-link',
            self::Blank => 'heroicon-o-arrow-top-right-on-square',
        };
    }
}
