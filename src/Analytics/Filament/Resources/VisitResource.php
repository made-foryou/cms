<?php

namespace Made\Cms\Analytics\Filament\Resources;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Made\Cms\Analytics\Filament\Resources\VisitResource\Pages;
use Made\Cms\Analytics\Models\Visit;

class VisitResource extends Resource
{
    protected static ?string $model = Visit::class;

    protected static ?string $slug = 'visits';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('session')
                    ->required(),

                TextInput::make('user_agent')
                    ->required(),

                TextInput::make('browser'),

                TextInput::make('browser_version'),

                TextInput::make('platform'),

                Checkbox::make('is_desktop'),

                TextInput::make('referer'),

                TextInput::make('request'),

                TextInput::make('response_code'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('session'),

                TextColumn::make('user_agent'),

                TextColumn::make('browser'),

                TextColumn::make('browser_version'),

                TextColumn::make('platform'),

                TextColumn::make('is_desktop'),

                TextColumn::make('referer'),

                TextColumn::make('request'),

                TextColumn::make('response_code'),
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
            'index' => Pages\ListVisits::route('/'),
            'create' => Pages\CreateVisit::route('/create'),
            'edit' => Pages\EditVisit::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['user']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['user.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->user) {
            $details['User'] = $record->user->name;
        }

        return $details;
    }

    public static function getNavigationGroup(): ?string
    {
        return __('made-cms::cms.navigation_groups.analytics');
    }
}
