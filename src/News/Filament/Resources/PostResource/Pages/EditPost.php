<?php

declare(strict_types=1);

namespace Made\Cms\News\Filament\Resources\PostResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Forms\Components\Component;
use Filament\Resources\Pages\EditRecord;
use Made\Cms\News\Filament\Resources\PostResource;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasBuilderPreview;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class EditPost extends EditRecord
{
    use HasPreviewModal;
    use HasBuilderPreview;

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            PreviewAction::make()->label('Preview'),

            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    protected function getPreviewModalView(): string
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
