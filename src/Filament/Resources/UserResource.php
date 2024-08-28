<?php

namespace Made\Cms\Filament\Resources;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Made\Cms\Filament\Resources;
use Made\Cms\Models\User;
use Made\Cms\Providers\CmsPanelServiceProvider;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $slug = 'users';

    protected static ?string $navigationIcon = 'heroicon-m-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('role_id')
                    ->label(__('made-cms::cms.resources.user.fields.role'))
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
                    ->label(__('made-cms::cms.resources.user.fields.email_verified_at')),

                TextInput::make('password')
                    ->label(__('made-cms::cms.resources.user.fields.password'))
                    ->password()
                    ->required(fn (string $context): bool => $context === 'create'),

                Placeholder::make('created_at')
                    ->label(__('made-cms::cms.resources.common.created_at'))
                    ->content(fn (?User $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label(__('made-cms::cms.resources.common.updated_at'))
                    ->content(fn (?User $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading(__('made-cms::cms.resources.user.heading'))
            ->description(__('made-cms::cms.resources.user.description'))
            ->columns([
                IconColumn::make('custom')
                    ->label('CMS Access?')
                    ->boolean()
                    ->getStateUsing(
                        fn (User $record) => $record->canAccessPanel(
                            filament()->getPanel(CmsPanelServiceProvider::ID)
                        )
                    ),

                TextColumn::make('role.name')
                    ->label(__('made-cms::cms.resources.user.fields.role'))
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
                    ->label(__('made-cms::cms.resources.user.fields.email_verified_at'))
                    ->date()
                    ->visibleFrom('xl'),

                TextColumn::make('created_at')
                    ->label(__('made-cms::cms.resources.common.created_at'))
                    ->date()
                    ->sortable()
                    ->visibleFrom('xl'),
            ])
            ->actions([
                ViewAction::make()
                    ->iconButton(),

                EditAction::make()
                    ->iconButton(),

                DeleteAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultPaginationPageOption(25);
    }

    public static function getPages(): array
    {
        return [
            'index' => Resources\UserResource\Pages\ListUsers::route('/'),
            'create' => Resources\UserResource\Pages\CreateUser::route('/create'),
            'view' => Resources\UserResource\Pages\ViewUser::route('/{record}'),
            'edit' => Resources\UserResource\Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['role']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email', 'role.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->role) {
            $details['Role'] = $record->role->name;
        }

        return $details;
    }

    /**
     * Gets the navigation group for the current user.
     *
     * This method returns the navigation group for the current user in the CMS.
     * The navigation group is a string that represents the user's group in the CMS.
     *
     * @return string|null The navigation group for the current user, or null if it cannot be determined.
     */
    public static function getNavigationGroup(): ?string
    {
        return __('made-cms::cms.groups.user');
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
}
