<?php

namespace Made\Cms\Language\Filament\Actions;

use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\Action;
use Made\Cms\Language\Actions\MakeLanguageDefault;
use Made\Cms\Language\Models\Language;

class MakeDefaultAction extends Action
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'default';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(
            __('made-cms::cms.resources.language.actions.default.label')
        );

        $this->icon('heroicon-o-star');

        $this->successNotificationTitle(
            fn (Language $record) => __(
                'made-cms::cms.resources.language.actions.default.successTitle',
                ['name' => ucfirst($record->name)]
            )
        );

        $this->requiresConfirmation();

        $this->modalHeading(
            fn (Language $record) => __(
                'made-cms::cms.resources.language.actions.default.heading',
                ['name' => ucfirst($record->name)]
            )
        );

        $this->modalDescription(
            fn (Language $record) => __(
                'made-cms::cms.resources.language.actions.default.description',
                ['name' => strtolower($record->name)]
            )
        );

        $this->action(function (Language $record) {
            MakeLanguageDefault::run($record);
            $this->success();
        });
    }
}
