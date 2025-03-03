<?php

namespace Made\Cms\Page\Filament\Resources\PageResource\Pages;

use Filament\Forms\Components\Component;
use Filament\Resources\Pages\CreateRecord;
use Made\Cms\Page\Filament\Resources\PageResource;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasBuilderPreview;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class CreatePage extends CreateRecord
{
    use HasBuilderPreview;
    use HasPreviewModal;

    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            PreviewAction::make()->label('Preview'),
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

    public static function getBuilderEditorSchema(string $builderName): Component | array
    {
        return PageResource::contentBuilderField(context: 'preview');
    }
}
