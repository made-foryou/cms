<?php

namespace Made\Cms\Filament\Clusters\Administration\Resources;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Made\Cms\Filament\Clusters\Administration;
use Made\Cms\Filament\Clusters\Administration\Resources\RoleResource\Pages;
use Made\Cms\Models\Role;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $slug = 'roles';

    protected static ?string $navigationIcon = 'heroicon-m-shield-check';

    protected static ?string $cluster = Administration::class;

    protected static ?string $navigationLabel = 'Rollen';

    protected static ?string $breadcrumb = 'Rollen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('made-cms::roles.sections.main.heading'))
                    ->description(__('made-cms::roles.sections.main.description'))
                    ->aside()
                    ->schema([
                        TextInput::make('name')
                            ->label(__('made-cms::roles.fields.name.label'))
                            ->required(),

                        Textarea::make('description')
                            ->label(__('made-cms::roles.fields.description.label'))
                            ->helperText(__('made-cms::roles.fields.description.helperText')),

                        Checkbox::make('is_default')
                            ->label(__('made-cms::roles.fields.is_default.label'))
                            ->helperText(__('made-cms::roles.fields.is_default.helperText')),

                        Placeholder::make('created_at')
                            ->label(__('made-cms::roles.fields.created_at.label'))
                            ->content(fn (?Role $record): string => $record?->created_at?->diffForHumans() ?? '-'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('made-cms::roles.fields.name.label'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description')
                    ->label(__('made-cms::roles.fields.description.label')),

                TextColumn::make('is_default')
                    ->tooltip(__('made-cms::roles.fields.is_default.helperText'))
                    ->label(__('made-cms::roles.fields.is_default.label'))
                    ->badge()
                    ->color(fn (bool $state): string => ($state ? 'success' : 'gray'))
                    ->formatStateUsing(fn (bool $state): string => ($state ? __('made-cms::common.yes') : __('made-cms::common.no'))),
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }
}
