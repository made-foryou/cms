<?php

namespace Made\Cms\Language\Filament\Resources;

use Exception;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Made\Cms\Language\Filament\Actions\MakeDefaultAction;
use Made\Cms\Language\Models\Language;

class LanguageResource extends Resource
{
    /**
     * Connected model.
     */
    protected static ?string $model = Language::class;

    /**
     * Slug name for this resource.
     */
    protected static ?string $slug = 'languages';

    /**
     * Sorting order for within the navigation.
     */
    protected static ?int $navigationSort = 8;

    /**
     * Configures the form schema for the resource.
     *
     * @param  Form  $form  The form instance being configured.
     * @return Form The configured form instance.
     *
     * @throws Exception
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('made-cms::cms.resources.common.name'))
                                    ->required(),

                                TextInput::make('country')
                                    ->label(__('made-cms::cms.resources.language.fields.country.label')),

                                TextInput::make('locale')
                                    ->label(__('made-cms::cms.resources.language.fields.locale.label'))
                                    ->helperText(__('made-cms::cms.resources.language.fields.locale.description'))
                                    ->required(),

                                TextInput::make('abbreviation')
                                    ->label(__('made-cms::cms.resources.language.fields.abbreviation.label'))
                                    ->helperText(__('made-cms::cms.resources.language.fields.abbreviation.description'))
                                    ->required(),

                                SpatieMediaLibraryFileUpload::make('flag')
                                    ->label(__('made-cms::cms.resources.language.fields.image.label'))
                                    ->helperText(__('made-cms::cms.resources.language.fields.image.description'))
                                    ->collection('flag')
                                    ->image()
                                    ->avatar()
                                    ->imageEditor(),

                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Toggle::make('is_default')
                                    ->label(__('made-cms::cms.resources.language.fields.is_default.label'))
                                    ->helperText(__('made-cms::cms.resources.language.fields.is_default.description'))
                                    ->disabled(),

                                Toggle::make('is_enabled')
                                    ->label(__('made-cms::cms.resources.language.fields.is_enabled.label'))
                                    ->helperText(__('made-cms::cms.resources.language.fields.is_enabled.description')),
                            ]),
                    ]),
            ])
            ->columns(3);
    }

    /**
     * Configures the table with columns, filters, actions, and bulk actions.
     *
     * @param  Table  $table  The table instance to configure.
     * @return Table Returns the configured table instance.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('made-cms::cms.resources.common.name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('country')
                    ->label(__('made-cms::cms.resources.language.fields.country.label')),

                TextColumn::make('locale')
                    ->label(__('made-cms::cms.resources.language.fields.locale.label')),

                TextColumn::make('abbreviation')
                    ->label(__('made-cms::cms.resources.language.fields.abbreviation.label')),

                SpatieMediaLibraryImageColumn::make('flag')
                    ->label(__('made-cms::cms.resources.language.fields.image.label'))
                    ->collection('flag')
                    ->conversion('flag')
                    ->circular(),

                TextColumn::make('is_default')
                    ->label(__('made-cms::cms.resources.language.fields.is_default.label'))
                    ->badge()
                    ->formatStateUsing(fn (bool $state) => ($state) ? __('made-cms::cms.resources.common.default') : __('made-cms::cms.resources.common.not_default'))
                    ->color(fn (bool $state) => ($state) ? 'success' : 'danger'),

                TextColumn::make('is_enabled')
                    ->label(__('made-cms::cms.resources.language.fields.is_enabled.label'))
                    ->badge()
                    ->formatStateUsing(fn (bool $state) => ($state) ? __('made-cms::cms.resources.common.enabled') : __('made-cms::cms.resources.common.not_enabled'))
                    ->color(fn (bool $state) => ($state) ? 'success' : 'danger'),
            ])
            ->filters([
                TernaryFilter::make('is_enabled')
                    ->label(__('made-cms::cms.resources.language.fields.is_enabled.label')),
            ])
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        MakeDefaultAction::make(),
                        EditAction::make(),
                    ])->dropdown(false),

                    DeleteAction::make(),
                ]),

            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * Retrieves an array of page routes for the LanguageResource.
     *
     * @return array An associative array where the keys represent page identifiers
     *               and the values are route definitions for the corresponding pages.
     */
    public static function getPages(): array
    {
        return [
            'index' => \Made\Cms\Language\Filament\Resources\LanguageResource\Pages\ListLanguages::route('/'),
            'create' => \Made\Cms\Language\Filament\Resources\LanguageResource\Pages\CreateLanguage::route('/create'),
            'edit' => \Made\Cms\Language\Filament\Resources\LanguageResource\Pages\EditLanguage::route('/{record}/edit'),
        ];
    }

    /**
     * Retrieves the attributes that are globally searchable.
     *
     * @return array Returns an array of attributes that can be searched globally.
     */
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
        return __('made-cms::cms.navigation_groups.website');
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

    /**
     * Retrieves the navigation badge value based on the count of enabled languages.
     *
     * @return string|null Returns the count of enabled languages as a string, or null if no languages are found.
     */
    public static function getNavigationBadge(): ?string
    {
        return Language::query()->enabled()->count();
    }
}
