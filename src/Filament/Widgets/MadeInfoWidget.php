<?php

namespace Made\Cms\Filament\Widgets;

use Filament\Widgets\Widget;

class MadeInfoWidget extends Widget
{
    protected static ?int $sort = -2;

    protected static bool $isLazy = false;

    protected static string $view = 'cms::filament.widgets.made-info-widget';
}
