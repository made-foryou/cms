<?php

declare(strict_types=1);

namespace Made\Cms\Shared\Filament\Actions;

use Exception;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Made\Cms\Language\Models\Language;
use Made\Cms\Page\Actions\CreateTranslationAction;

class TranslateAction extends Action
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'translate';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(
            __('made-cms::cms.resources.page.actions.translate.label'),
        );

        $this->icon('heroicon-o-language');

        $this->modalHeading(
            __('made-cms::cms.resources.page.actions.translate.heading')
        );

        $this->modalDescription(
            __('made-cms::cms.resources.page.actions.translate.description')
        );

        $this->modalWidth(MaxWidth::Medium);

        $this->modalIcon('heroicon-o-language');
        $this->modalIconColor('primary');

        $this->failureNotificationTitle(
            fn (Model $record) => __(
                'made-cms::cms.resources.page.actions.translate.failure.title',
                ['name' => $record->name]
            )
        );

        $this->successNotificationTitle(
            fn (Model $record) => __(
                'made-cms::cms.resources.page.actions.translate.success.title',
                ['name' => $record->name]
            )
        );

        $this->form([
            Select::make('language')
                ->label(__('made-cms::cms.resources.page.actions.translate.fields.language.label'))
                ->helperText(__('made-cms::cms.resources.page.actions.translate.fields.language.helperText'))
                ->options(
                    Language::query()
                        ->enabled()
                        ->get()
                        ->mapWithKeys(
                            fn (Language $language) => [
                                $language->id => $language->name,
                            ]
                        )
                )
                ->required(),
        ]);

        $this->action(function (Model $record, array $data) {
            try {
                $translation = CreateTranslationAction::run(
                    $record,
                    Language::findOrFail($data['language']),
                    request()->user(),
                );

                $this->success();
            } catch (Exception $exception) {
                $this->failure();
            }
        });
    }
}
