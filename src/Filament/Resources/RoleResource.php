<?php

namespace Made\Cms\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Made\Cms\Models\Permission;
use Made\Cms\Models\Role;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $slug = 'roles';

    /**
     * Generates and returns the schema for the provided form.
     *
     * @param  Forms\Form  $form  The form object to which the schema will be added.
     * @return Forms\Form The form object with its schema defined.
     */
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('made-cms::cms.resources.role.form.sections.main.heading'))
                    ->description(__('made-cms::cms.resources.role.form.sections.main.description'))
                    ->icon('heroicon-o-identification')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('made-cms::cms.resources.role.form.fields.name.label'))
                            ->required(),

                        Forms\Components\Textarea::make('description')
                            ->label(__('made-cms::cms.resources.role.form.fields.description.label'))
                            ->helperText(__('made-cms::cms.resources.role.form.fields.description.helperText')),

                        Forms\Components\Checkbox::make('is_default')
                            ->label(__('made-cms::cms.resources.role.form.fields.is_default.label'))
                            ->helperText(__('made-cms::cms.resources.role.form.fields.is_default.helperText')),

                        Forms\Components\Placeholder::make('created_at')
                            ->label(__('made-cms::cms.resources.common.created_at'))
                            ->content(fn (?Role $record): string => $record?->created_at?->diffForHumans() ?? '-'),
                    ])
                    ->columnSpan(1)
                    ->collapsible(),

                Forms\Components\Section::make(__('made-cms::cms.resources.role.form.sections.permissions.heading'))
                    ->description(__('made-cms::cms.resources.role.form.sections.permissions.description'))
                    ->icon('heroicon-o-adjustments-horizontal')
                    ->columns([
                        'default' => 1,
                        'lg' => 2,
                    ])
                    ->schema(self::getPermissionSections())
                    ->columnSpan(2)
                    ->collapsible(),
            ])
            ->columns(3);
    }

    /**
     * Generates and returns an array of permission sections, each representing
     * grouped permissions by their subjects, for use in form schemas.
     *
     * This method queries all permissions, groups them by their subject, and
     * creates form sections with checkboxes for managing permissions. Each section
     * includes descriptive details of the permissions and supports bulk toggling.
     *
     * @return array An array of form section components defining permission controls.
     */
    protected static function getPermissionSections(): array
    {
        $sections = collect();

        $permissions = Permission::all()->groupBy('subject');

        $permissions->each(function (Collection $collection, string $key) use (&$sections) {

            $relation = explode('.', $collection->first()->key)[0];

            $sections->push(
                Forms\Components\Section::make(__('made-cms::cms.class_names.' . $key . '.title'))
                    ->description(__('made-cms::cms.class_names.' . $key . '.description'))
                    ->schema([
                        Forms\Components\CheckboxList::make($relation . 'Permissions')
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
                            ->meta('key', $key)
                            ->disabled(fn (?Role $record): bool => $record?->is_default ?? false)
                            ->bulkToggleable(),
                    ])
                    ->columnSpan(1)
                    ->collapsible()
                    ->collapsed(fn (?Role $record): bool => $record?->is_default ?? false),
            );
        });

        return $sections->toArray();
    }

    /**
     * Configures the table by defining its columns, filters, actions, and bulk actions.
     *
     * @param  Tables\Table  $table  The table instance to be configured.
     * @return Tables\Table The configured table instance.
     */
    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('made-cms::cms.resources.role.table.name.label'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label(__('made-cms::cms.resources.role.table.description.label'))
                    ->tooltip(__('made-cms::cms.resources.role.table.description.description')),

                Tables\Columns\TextColumn::make('is_default')
                    ->tooltip(__('made-cms::cms.resources.role.table.is_default.tooltip'))
                    ->label(__('made-cms::cms.resources.role.table.is_default.label'))
                    ->badge()
                    ->color(fn (bool $state): string => ($state ? 'success' : 'gray'))
                    ->formatStateUsing(fn (bool $state): string => ($state ? __('made-cms::cms.common.yes') : __('made-cms::cms.common.no'))),

                Tables\Columns\TextColumn::make('users_count')
                    ->counts('users')
                    ->label(__('made-cms::cms.resources.role.table.users_count.label')),
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

    /**
     * Retrieves the defined routes for the pages of the resource.
     *
     * @return array An associative array where keys are page identifiers and values are their corresponding routes.
     */
    public static function getPages(): array
    {
        return [
            'index' => \Made\Cms\Filament\Resources\RoleResource\Pages\ListRoles::route('/'),
            'create' => \Made\Cms\Filament\Resources\RoleResource\Pages\CreateRole::route('/create'),
            'edit' => \Made\Cms\Filament\Resources\RoleResource\Pages\EditRole::route('/{record}/edit'),
        ];
    }

    /**
     * Retrieves an array of relation managers associated with the class.
     *
     * @return array The list of relation manager class names.
     */
    public static function getRelations(): array
    {
        return [
            //            RelationManagers\PermissionsRelationManager::class,
        ];
    }

    /**
     * Retrieves an array of attributes that are globally searchable.
     *
     * @return array An array of attribute names that can be searched globally.
     */
    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }

    /**
     * Retrieves the navigation group label for the security section.
     *
     * @return string|null The localized label for the security navigation group, or null if not set.
     */
    public static function getNavigationGroup(): ?string
    {
        return __('made-cms::cms.navigation_groups.security');
    }

    /**
     * Retrieves the navigation label for the role resource.
     *
     * @return string The localized label for the role resource.
     */
    public static function getNavigationLabel(): string
    {
        return __('made-cms::cms.resources.role.label');
    }

    /**
     * Retrieves the breadcrumb label for the role resource.
     *
     * @return string The localized breadcrumb label.
     */
    public static function getBreadcrumb(): string
    {
        return __('made-cms::cms.resources.role.label');
    }

    /**
     * Retrieves the navigation badge value by counting the number of roles.
     *
     * @return string|null The navigation badge value as a string or null if no roles exist.
     */
    public static function getNavigationBadge(): ?string
    {
        return Role::count();
    }
}
