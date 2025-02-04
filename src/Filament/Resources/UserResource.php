<?php

declare(strict_types=1);

namespace Made\Cms\Filament\Resources;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Made\Cms\Models\Role;
use Made\Cms\Models\User;
use Made\Cms\Providers\CmsPanelServiceProvider;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $slug = 'users';

    /**
     * Configures the form structure, including field definitions and sections for user data.
     *
     * @param  Form  $form  An instance of the Form object to be configured.
     * @return Form The configured Form object.
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('made-cms::cms.resources.user.form.sections.user.heading'))
                    ->description(__('made-cms::cms.resources.user.form.sections.user.description'))
                    ->aside()
                    ->schema([

                        Select::make('role_id')
                            ->label(__('made-cms::cms.resources.user.form.fields.role.label'))
                            ->helperText(__('made-cms::cms.resources.user.form.fields.role.helperText'))
                            ->relationship('role', 'name')
                            ->preload()
                            ->searchable()
                            ->required(),

                        TextInput::make('name')
                            ->label(__('made-cms::cms.resources.common.name'))
                            ->required(),

                        TextInput::make('email')
                            ->label(__('made-cms::cms.resources.common.email'))
                            ->required(),

                        DatePicker::make('email_verified_at')
                            ->label(__('made-cms::cms.resources.user.form.fields.email_verified_at.label')),

                        TextInput::make('password')
                            ->label(__('made-cms::cms.resources.user.form.fields.password.label'))
                            ->password()
                            ->helperText(
                                fn (string $context): string => $context === 'edit'
                                    ? __('made-cms::cms.resources.user.form.fields.password.helperText')
                                    : ''
                            )
                            ->required(fn (string $context): bool => $context === 'create')
                            ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
                            ->dehydrated(fn ($state): bool => filled($state))
                            ->required(fn (string $context): bool => $context === 'create'),
                    ]),
            ]);
    }

    /**
     * Configures the table structure, including column definitions, actions, and bulk actions.
     *
     * @param  Table  $table  An instance of the Table object to be configured.
     * @return Table The configured Table object.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->heading(__('made-cms::cms.resources.user.table.heading'))
            ->description(__('made-cms::cms.resources.user.table.description'))
            ->columns([
                IconColumn::make('cms_access')
                    ->label(__('made-cms::cms.resources.user.table.columns.cms_access.label'))
                    ->boolean()
                    ->getStateUsing(
                        fn (User $record) => $record->canAccessPanel(
                            filament()->getPanel(CmsPanelServiceProvider::ID)
                        )
                    ),

                TextColumn::make('role.name')
                    ->label(__('made-cms::cms.resources.user.table.columns.role_name.label'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label(__('made-cms::cms.resources.common.name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label(__('made-cms::cms.resources.common.email'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email_verified_at')
                    ->label(__('made-cms::cms.resources.user.table.columns.email_verified_at.label'))
                    ->date()
                    ->visibleFrom('xl'),

                TextColumn::make('created_at')
                    ->label(__('made-cms::cms.resources.common.created_at'))
                    ->date()
                    ->sortable()
                    ->visibleFrom('xl'),
            ])
            ->filters([
                SelectFilter::make('role_id')
                    ->label(__('made-cms::cms.resources.user.fields.role'))
                    ->options(
                        Role::all()->mapWithKeys(
                            fn (Role $role) => [$role->id => $role->name]
                        )
                    ),
            ])
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        ViewAction::make(),
                        EditAction::make(),
                    ])->dropdown(false),

                    DeleteAction::make(),
                ])->iconButton(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultPaginationPageOption(25);
    }

    /**
     * Configures the infolist structure, including section and field definitions.
     *
     * @param  Infolist  $infolist  An instance of the Infolist object to be configured.
     * @return Infolist The configured Infolist object.
     */
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                \Filament\Infolists\Components\Section::make(
                    __('made-cms::cms.resources.user.infolist.sections.user.heading')
                )
                    ->description(__('made-cms::cms.resources.user.infolist.sections.user.description'))
                    ->aside()
                    ->columns()
                    ->schema([

                        TextEntry::make('name')
                            ->label(__('made-cms::cms.resources.common.name')),

                        TextEntry::make('email')
                            ->label(__('made-cms::cms.resources.common.email')),

                        TextEntry::make('email_verified_at')
                            ->label(__('made-cms::cms.resources.user.infolist.entries.email_verified_at.label'))
                            ->date()
                            ->columns(),

                    ]),

                \Filament\Infolists\Components\Section::make(__('made-cms::cms.resources.user.infolist.sections.management.heading'))
                    ->description(__('made-cms::cms.resources.user.infolist.sections.management.description'))
                    ->aside()
                    ->columns()
                    ->schema([

                        TextEntry::make('id')
                            ->label('id'),

                        TextEntry::make('role.name')
                            ->label(__('made-cms::cms.resources.user.infolist.entries.role_name.label')),

                        TextEntry::make('created_at')
                            ->label(__('made-cms::cms.resources.common.created_at'))
                            ->date(),

                        TextEntry::make('updated_at')
                            ->label(__('made-cms::cms.resources.common.updated_at'))
                            ->date(),

                        TextEntry::make('deleted_at')
                            ->label(__('made-cms::cms.resources.common.deleted_at'))
                            ->date()
                            ->hidden(fn (User $user) => $user->deleted_at === null),

                    ]),
            ]);
    }

    /**
     * Retrieves a list of pages for user resources with their corresponding routes.
     *
     * @return array An associative array where the keys are page identifiers and the values are routes.
     */
    public static function getPages(): array
    {
        return [
            'index' => \Made\Cms\Filament\Resources\UserResource\Pages\ListUsers::route('/'),
            'create' => \Made\Cms\Filament\Resources\UserResource\Pages\CreateUser::route('/create'),
            'view' => \Made\Cms\Filament\Resources\UserResource\Pages\ViewUser::route('/{record}'),
            'edit' => \Made\Cms\Filament\Resources\UserResource\Pages\EditUser::route('/{record}/edit'),
        ];
    }

    /**
     * Retrieves the global search Eloquent query with the associated role relation.
     *
     * This method extends the default global search query by including the 'role'
     * relationship for more comprehensive search results.
     *
     * @return Builder The modified Eloquent query builder instance.
     */
    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['role']);
    }

    /**
     * Retrieves the globally searchable attributes.
     *
     * This method returns an array of attribute names that are considered
     * globally searchable. These attributes typically include fields that
     * are commonly used in search operations across different parts of the
     * application.
     *
     * @return array An array of attribute names that are globally searchable.
     */
    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email', 'role.name'];
    }

    /**
     * Retrieves the global search result details for a given record.
     *
     * This method returns an array containing specific details of the provided record,
     * such as the role name if the record has an associated role.
     *
     * @param  Model  $record  The record from which details are to be fetched.
     * @return array An associative array containing the details of the record.
     *               E.g., ['Role' => 'Admin'] if the record has a role.
     */
    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->role) {
            $details['Role'] = $record->role->name;
        }

        return $details;
    }

    /**
     * Gets the label for the model.
     *
     * This method returns the label for the model in the CMS.
     * The label is a string that represents the singular form of the model's resource in the CMS.
     *
     * @return string The label for the model.
     */
    public static function getModelLabel(): string
    {
        return __('made-cms::cms.resources.user.singular');
    }

    /**
     * Retrieves the plural label for the user resource.
     *
     * This method returns the translated plural label for the user resource,
     * as defined in the localization file "made-cms::cms.resources.user.label".
     *
     * @return string|null The translated plural label for the user resource.
     *                     Returns null if the translation is not found.
     */
    public static function getPluralLabel(): ?string
    {
        return __('made-cms::cms.resources.user.label');
    }

    /**
     * Retrieves the navigation group label for the security section.
     *
     * @return string|null The navigation group label, or null if unavailable.
     */
    public static function getNavigationGroup(): ?string
    {
        return __('made-cms::cms.navigation_groups.security');
    }

    /**
     * Retrieves the navigation badge displaying the count of users.
     *
     * @return string|null The count of users as a string, or null if no users exist.
     */
    public static function getNavigationBadge(): ?string
    {
        return (string) User::count();
    }
}
