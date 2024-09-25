<?php

namespace Made\Cms\Filament\Clusters\Administration\Resources\RoleResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Made\Cms\Models\Permission;

class PermissionsRelationManager extends RelationManager
{
    protected static string $relationship = 'permissions';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->defaultGroup(
                Tables\Grouping\Group::make('subject')
                    ->label('')
                    ->getTitleFromRecordUsing(
                        fn (Permission $record): string => __('made-cms::class_names.' . $record->subject . '.title')
                    )
                    ->getDescriptionFromRecordUsing(
                        fn (Permission $record): string => __('made-cms::class_names.' . $record->subject . '.description')
                    )
                    ->collapsible()
            )
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->label(__('made-cms::cms.resources.common.name'))
                    ->description(
                        fn (Permission $record): string => $record->description
                    ),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('made-cms::cms.resources.common.created_at'))
                    ->date(),

            ])
            ->selectable()
            ->searchable();
    }
}
