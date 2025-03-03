<?php

namespace Made\Cms\News\Filament\Resources\PostResource\Pages;

use Filament\Forms\Components\Component;
use Filament\Resources\Pages\CreateRecord;
use Made\Cms\News\Filament\Resources\PostResource;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasBuilderPreview;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class CreatePost extends CreateRecord
{
    use HasPreviewModal;
    use HasBuilderPreview;

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            PreviewAction::make()->label('Preview'),
        ];
    }

    protected function getPreviewModalView(): ?string
    {
        return 'cms::preview.post';
    }

    protected function getBuilderPreviewView(string $builderName): ?string
    {
        return 'cms::preview.post-content';
    }

    public static function getBuilderEditorSchema(string $builderName): Component|array
    {
        return PostResource::contentBuilderField(context: 'preview');
    }
}
