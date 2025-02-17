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
            self::Self => 'Huidig venster',
            self::Blank => 'Nieuw venster',
        };
    }

    public function getDescription(): string
    {
        return match ($this) {
            self::Self => 'De link wordt geopend in hetzelfde tabblad.',
            self::Blank => 'De link wordt geopend in een nieuw tabblad.',
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
