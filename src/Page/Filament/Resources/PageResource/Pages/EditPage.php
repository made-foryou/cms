<?php

declare(strict_types=1);

namespace Made\Cms\Page\Filament\Resources\PageResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Component;
use Filament\Resources\Pages\EditRecord;
use Made\Cms\Page\Filament\Resources\PageResource;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasBuilderPreview;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class EditPage extends EditRecord
{
    use HasPreviewModal;
    use HasBuilderPreview;

    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            PreviewAction::make()->label('Preview'),

            DeleteAction::make(),
        ];
    }

    protected function getPreviewModalView(): ?string
    {
        return 'cms::preview.page';
    }

    protected function getBuilderPreviewView(string $builderName): ?string
    {
        return 'cms::preview.page-content';
    }

    public static function getBuilderEditorSchema(string $builderName): Component|array
    {
        return PageResource::contentBuilderField(context: 'preview');
    }
}
