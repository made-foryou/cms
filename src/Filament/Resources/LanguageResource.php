<?php

namespace Made\Cms\Filament\Resources;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Made\Cms\Filament\Resources\LanguageResource\Pages;
use Made\Cms\Models\Language;

class LanguageResource extends Resource
{
    protected static ?string $model = Language::class;

    protected static ?string $slug = 'languages';

    protected static ?string $navigationIcon = 'heroicon-o-language';

    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),

                TextInput::make('country'),

                TextInput::make('locale')
                    ->required(),

                TextInput::make('abbreviation')
                    ->required(),

                Checkbox::make('is_default'),

                Checkbox::make('is_enabled'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('country'),

                TextColumn::make('locale'),

                TextColumn::make('abbreviation'),

                ImageColumn::make('image'),

                TextColumn::make('is_default')
                    ->badge()
                    ->formatStateUsing(fn (bool $state) => ($state) ? __('made-cms::cms.resources.common.default') : __('made-cms::cms.resources.common.not_default'))
                    ->color(fn (bool $state) => ($state) ? 'success' : 'danger'),

                TextColumn::make('is_enabled')
                    ->badge()
                    ->formatStateUsing(fn (bool $state) => ($state) ? __('made-cms::cms.resources.common.enabled') : __('made-cms::cms.resources.common.not_enabled'))
                    ->color(fn (bool $state) => ($state) ? 'success' : 'danger'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLanguages::route('/'),
            'create' => Pages\CreateLanguage::route('/create'),
            'edit' => Pages\EditLanguage::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }

    /**
     * Retrieves the navigation group for the website management section.
     *
     * @return string|null The navigation group label for website management, or null if not set.
     */
    public static function getNavigationGroup(): ?string
    {
        return __('made-cms::cms.groups.website_management');
    }

    /**
     * Retrieves the singular label for the model.
     *
     * @return string The singular label for the model.
     */
    public static function getModelLabel(): string
    {
        return __('made-cms::cms.resources.language.singular');
    }

    /**
     * Retrieves the plural label for the model.
     *
     * @return string The plural label for the model.
     */
    public static function getPluralModelLabel(): string
    {
        return __('made-cms::cms.resources.language.label');
    }
}
