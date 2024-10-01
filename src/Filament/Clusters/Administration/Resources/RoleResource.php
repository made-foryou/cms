<?php

namespace Made\Cms\Filament\Clusters\Administration\Resources;

use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Made\Cms\Filament\Clusters\Administration;
use Made\Cms\Filament\Clusters\Administration\Resources\RoleResource\Pages;
use Made\Cms\Models\Permission;
use Made\Cms\Models\Role;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $slug = 'roles';

    protected static ?string $navigationIcon = 'heroicon-m-shield-check';

    protected static ?string $cluster = Administration::class;

    protected static ?string $navigationLabel = 'Rollen';

    protected static ?string $breadcrumb = 'Rollen';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('made-cms::roles.sections.main.heading'))
                    ->description(__('made-cms::roles.sections.main.description'))
                    ->aside()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('made-cms::roles.fields.name.label'))
                            ->required(),

                        Forms\Components\Textarea::make('description')
                            ->label(__('made-cms::roles.fields.description.label'))
                            ->helperText(__('made-cms::roles.fields.description.helperText')),

                        Forms\Components\Checkbox::make('is_default')
                            ->label(__('made-cms::roles.fields.is_default.label'))
                            ->helperText(__('made-cms::roles.fields.is_default.helperText')),

                        Forms\Components\Placeholder::make('created_at')
                            ->label(__('made-cms::roles.fields.created_at.label'))
                            ->content(fn (?Role $record): string => $record?->created_at?->diffForHumans() ?? '-'),
                    ]),

                Forms\Components\Section::make(__('made-cms::roles.sections.permissions.label'))
                    ->description(__('made-cms::roles.sections.permissions.description'))
                    ->aside()
                    ->columns([
                        'default' => 1,
                        'lg' => 2,
                    ])
                    ->schema(self::getPermissionSections()),
            ]);
    }

    protected static function getPermissionSections(): array
    {
        $sections = collect();

        $permissions = Permission::all()->groupBy('subject');

        $permissions->each(fn (Collection $collection, string $key) => $sections->push(
            Forms\Components\Section::make(__('made-cms::class_names.' . $key . '.title'))
                ->description(__('made-cms::class_names.' . $key . '.description'))
                ->schema([
                    Forms\Components\CheckboxList::make('permissions')
                        ->relationship(
                            name: 'permissions',
                            titleAttribute: 'name',
                            modifyQueryUsing: fn (Builder $query) => $query->where('subject', $key)
                        )
                        ->descriptions(
                            descriptions: $collection->mapWithKeys(
                                fn (Permission $permission) => [$permission->id => $permission->description],
                            )->toArray()
                        )
                        ->disabled(fn (?Role $record): bool => $record?->is_default ?? false)
                        ->bulkToggleable(),
                ])
                ->columnSpan(1)
                ->collapsible()
                ->collapsed(fn (?Role $record): bool => $record?->is_default ?? false),
        ));

        return $sections->toArray();
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('made-cms::roles.fields.name.label'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label(__('made-cms::roles.fields.description.label')),

                Tables\Columns\TextColumn::make('is_default')
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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

    public static function getRelations(): array
    {
        return [
            //            RelationManagers\PermissionsRelationManager::class,
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }
}
